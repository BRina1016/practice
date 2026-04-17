<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Services\ZohoService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class ReservationController extends Controller
{
    private $zoho;

    public function __construct(ZohoService $zoho)
    {
        $this->middleware('auth');
        $this->zoho = $zoho;
    }

    public function completeReservation(Request $request, $store_id)
    {
        $validated = $request->validate([
            'date' => 'required|date',
            'hour' => 'required|string|regex:/^\d{2}$/',
            'minute' => 'required|string|regex:/^\d{2}$/',
            'number_of_people' => 'required|integer|min:1',
        ]);

        $validated['hour'] = (int) $validated['hour'];
        $validated['minute'] = (int) $validated['minute'];

        $time = str_pad($validated['hour'], 2, '0', STR_PAD_LEFT) . ':' . str_pad($validated['minute'], 2, '0', STR_PAD_LEFT);

        $reservation = Reservation::create([
            'store_id' => $store_id,
            'user_id' => Auth::id(),
            'date' => $validated['date'],
            'time' => $time,
            'number_of_people' => $validated['number_of_people'],
        ]);

        $reservationCode = 'RSV-' . str_pad($reservation->id, 6, '0', STR_PAD_LEFT);

        $contactResponse = $this->zoho->createContact(
            Auth::user()->name,
            Auth::user()->email
        );

        $contactId = $contactResponse['data'][0]['details']['id'] ?? null;

        $response = $this->zoho->createDeal(
            $reservationCode,
            $validated['date'],
            $time,
            $validated['number_of_people'],
            $contactId
        );

        $reservation->zoho_deal_id = $response['data'][0]['details']['id'] ?? null;
    $reservation->save();

    if (!empty($reservation->zoho_deal_id)) {

        $reservation->load(['store', 'user']);

        $pdf = Pdf::loadView('pdf.reservation', compact('reservation'));

        $fileName = 'reservation_' . str_pad($reservation->id, 6, '0', STR_PAD_LEFT) . '.pdf';
        $filePath = storage_path('app/' . $fileName);

        $pdf->save($filePath);

        $this->zoho->uploadAttachmentToDeal(
            $reservation->zoho_deal_id,
            $filePath
        );
    }

    return redirect()->route('reservation.done')->with('reservationData', [
        'date' => $validated['date'],
        'time' => $time,
        'number_of_people' => $validated['number_of_people'],
        ]);
    }

    public function showDonePage(Request $request)
    {
        $reservationData = $request->session()->get('reservationData');

        return view('done', compact('reservationData'));
    }

    public function delete($id)
    {
        $reservation = Reservation::findOrFail($id);

        if (!empty($reservation->zoho_deal_id)) {
            $this->zoho->deleteDeal($reservation->zoho_deal_id);
        }

        $reservation->delete();

        return redirect()->route('mypage')->with('status', '予約が削除されました。');
    }
}