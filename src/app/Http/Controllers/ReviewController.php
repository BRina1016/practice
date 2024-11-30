<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function store(Request $request)
    {

        $validated = $request->validate([
            'store_id' => 'required|exists:stores,store_id',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|max:1000',
        ]);

        $review = Review::create($validated);

        return response()->json([
            'success' => true,
            'review' => $review,
        ]);
    }
    public function index($storeId)
    {
        $reviews = Review::where('store_id', $storeId)->orderBy('created_at', 'desc')->get();
        return response()->json($reviews);
    }
}
