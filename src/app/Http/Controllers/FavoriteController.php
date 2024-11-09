<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Store;
use App\Models\Area;
use App\Models\Genre;
use Illuminate\Support\Facades\Session;

class FavoriteController extends Controller
{
    public function store(Request $request)
    {
        $user = Auth::user();
        $storeId = $request->input('store_id');

        if (Session::get('favorite_action_token')) {
            return response()->json(['message' => 'Action already in progress'], 429);
        }
        Session::put('favorite_action_token', true);

        try {
            DB::beginTransaction();

            $existingFavorite = DB::table('favorites')
                ->where('user_id', $user->id)
                ->where('store_id', $storeId)
                ->first();

            if ($existingFavorite) {
                DB::table('favorites')
                    ->where('user_id', $user->id)
                    ->where('store_id', $storeId)
                    ->delete();
                $message = 'Removed from favorites';
            } else {
                DB::table('favorites')->insert([
                    'user_id' => $user->id,
                    'store_id' => $storeId,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
                $message = 'Added to favorites';
            }

            DB::commit();
            return response()->json(['message' => $message]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'An error occurred: ' . $e->getMessage()], 500);
        } finally {
            Session::forget('favorite_action_token');
        }
    }

    public function destroyFromMypage(Request $request)
    {
        $user = Auth::user();
        $storeId = $request->input('store_id');

        try {
            DB::table('favorites')
                ->where('user_id', $user->id)
                ->where('store_id', $storeId)
                ->delete();
            return response()->json(['message' => 'Removed from favorites']);
        } catch (\Exception $e) {
            return response()->json(['message' => 'An error occurred: ' . $e->getMessage()], 500);
        }
    }

    public function index()
    {
        $user = Auth::user();
        $favorites = $user ? DB::table('favorites')
            ->where('user_id', $user->id)
            ->pluck('store_id')
            ->toArray() : [];

        $stores = Store::all();
        $areas = Area::all();
        $genres = Genre::all();

        return view('index', compact('stores', 'favorites', 'areas', 'genres'));
    }
}
