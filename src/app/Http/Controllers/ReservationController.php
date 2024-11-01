<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
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

        Reservation::create([
            'store_id' => $store_id,
            'user_id' => Auth::id(),
            'date' => $validated['date'],
            'time' => $time,
            'number_of_people' => $validated['number_of_people'],
        ]);

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
}