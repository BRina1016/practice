<?php

namespace App\Http\Controllers;

use App\Models\Store;
use Illuminate\Http\Request;

class MyPageController extends Controller
{
    public function index()
    {
        $stores = Store::with(['area', 'genre'])->get();

        return view('mypage', compact('stores'));
    }
}
