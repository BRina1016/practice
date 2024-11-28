<?php

namespace App\Http\Controllers;

use App\Models\Store;
use App\Models\Reservation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

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

        $reservation->update([
            'date' => $request->input('date'),
            'time' => $request->input('hour') . ':' . $request->input('minute') . ':00',
            'number_of_people' => $request->input('number_of_people'),
        ]);

        return redirect()->route('mypage')->with('success', '予約が更新されました。');
    }
}
