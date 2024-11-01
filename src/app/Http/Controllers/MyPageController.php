<?php

namespace App\Http\Controllers;

use App\Models\Store;
use App\Models\Reservation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class MyPageController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // ユーザーの予約情報を取得し、店舗情報も合わせて取得
        $reservations = Reservation::where('user_id', $user->id)
                                    ->with('store') // `Reservation`モデルに`store`リレーションが設定されている場合
                                    ->get();

        // お気に入りの店舗情報（例として2件のみ取得）
        $stores = Store::with(['area', 'genre'])->take(2)->get();

        // 必要なデータをビューに渡す
        return view('mypage', compact('user', 'reservations', 'stores'));
    }
}
