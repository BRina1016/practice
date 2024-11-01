<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function completeReservation(Request $request, $store_id)
    {
        $validated = [
            'date' => $request->input('date'),
            'hour' => $request->input('hour'),
            'minute' => $request->input('minute'),
            'number_of_people' => $request->input('number_of_people'),
        ];

        $time = str_pad($validated['hour'], 2, '0', STR_PAD_LEFT) . ':' . str_pad($validated['minute'], 2, '0', STR_PAD_LEFT);

        try {
            Reservation::create([
                'store_id' => $store_id,
                'date' => $validated['date'],
                'time' => $time,
                'number_of_people' => $validated['number_of_people'],
            ]);
        } catch (\Exception $e) {
            \Log::error('Database save error: ' . $e->getMessage());
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

        if (!$reservationData) {
            \Log::error('No reservation data found in session.');
        }

        return view('done', compact('reservationData'));
    }
}
