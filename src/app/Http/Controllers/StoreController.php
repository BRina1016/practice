<?php

namespace App\Http\Controllers;
use App\Models\Store;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    public function index()
    {
        $stores = Store::with(['area', 'genre'])->get();

        return view('index', compact('stores'));
    }

    public function show($store_id)
    {
        $store = Store::with(['area', 'genre'])->where('store_id', $store_id)->firstOrFail();

        return view('store.detail', compact('store'));
    }
}
