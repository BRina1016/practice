<?php

namespace App\Http\Controllers;

use App\Models\Store;
use App\Models\Reservation;
use App\Services\ZohoService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class MyPageController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $reservations = Reservation::where('user_id', $user->id)
                                    ->with('store')
                                    ->get();

        $favorites = $user ? DB::table('favorites')
                            ->where('user_id', $user->id)
                            ->pluck('store_id')
                            ->toArray() : [];

        $stores = Store::with(['area', 'genre'])
                        ->whereIn('store_id', $favorites)
                        ->get();

        return view('mypage', compact('user', 'reservations', 'favorites', 'stores'));
    }

    public function editReservation($id)
    {
        $reservation = Reservation::findOrFail($id);
        return response()->json($reservation);
    }

    public function updateReservation(Request $request, $id)
    {
        $reservation = Reservation::findOrFail($id);

        $time = $request->input('hour') . ':' . $request->input('minute');

        $reservation->update([
            'date' => $request->input('date'),
            'time' => $time . ':00',
            'number_of_people' => $request->input('number_of_people'),
        ]);

        if (!empty($reservation->zoho_deal_id)) {
            $this->zoho->updateDeal(
                $reservation->zoho_deal_id,
                $request->input('date'),
                $time,
                $request->input('number_of_people')
            );
        }

        return redirect()->route('mypage')->with('success', '予約が更新されました。');
    }

    private $zoho;

    public function __construct(ZohoService $zoho)
    {
        $this->zoho = $zoho;
    }

    public function downloadReservationPdf($id)
    {
        $reservation = Reservation::with(['store', 'user'])->findOrFail($id);

        $pdf = Pdf::loadView('pdf.reservation', compact('reservation'));

        $fileName = 'reservation_' . str_pad($reservation->id, 6, '0', STR_PAD_LEFT) . '.pdf';

        return $pdf->download($fileName);
    }

    private function generateReservationPdfFile($reservation)
    {
        $pdf = Pdf::loadView('pdf.reservation', compact('reservation'));

        $fileName = 'reservation_' . str_pad($reservation->id, 6, '0', STR_PAD_LEFT) . '.pdf';
        $filePath = storage_path('app/public/' . $fileName);

        $pdf->save($filePath);

        return $filePath;
    }

}
