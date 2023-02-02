<?php

namespace App\Http\Controllers\API;

use App\Models\Review;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $reviews = Review::all();

        return response()->json($reviews);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'rating'    => 'required'
        ]);

        $newReview = new Review([
            'rating'    => $request->get('rating'),
            'title'     => $request->get('title'),
            'content'   => $request->get('content'),
            'user_id'   => $request->get('user_id'),
        ]);

        $newReview->save();

        return response()->json($newReview);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $review = Review::findOrFail($id);

        return response()->json($review);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $review = Review::findOrFail($id);

        $request->validate([
            'rating'    => 'required'
        ]);

        $review->rating = $request->get('rating');
        $review->title = $request->get('title');
        $review->content = $request->get('content');

        $review->save();

        return response()->json($review);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $review = Review::findOrFail($id);
        $review->delete();

        return response()->json($review::all());
    }
}
