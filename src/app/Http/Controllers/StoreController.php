<?php

namespace App\Http\Controllers;

use App\Models\Store;
use App\Models\Area;
use App\Models\Genre;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    public function index(Request $request)
    {
        $areaId = $request->input('area_id');
        $genreId = $request->input('genre_id');
        $keyword = $request->input('keyword');

        $query = Store::query();

        if ($areaId && $areaId != 'all') {
            $query->where('area_id', $areaId);
        }

        if ($genreId && $genreId != 'all') {
            $query->where('genre_id', $genreId);
        }

        if ($keyword) {
            $query->where('name', 'LIKE', '%' . $keyword . '%');
        }

        $stores = $query->with('reviews')->get();

        $areas = Area::all();
        $genres = Genre::all();

        $favorites = [];
        if (auth()->check()) {
            $favorites = auth()->user()->favorites->pluck('store_id')->toArray();
        }

        return view('index', compact('stores', 'areas', 'genres', 'areaId', 'genreId', 'keyword', 'favorites'));
    }

    public function show($store_id)
    {
        $store = Store::where('store_id', $store_id)->with('reviews')->firstOrFail();

        return view('store.detail', compact('store'));
    }
}
