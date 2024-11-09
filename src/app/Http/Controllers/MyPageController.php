<?php

namespace App\Http\Controllers;

use App\Models\Store;
use App\Models\Reservation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
}
