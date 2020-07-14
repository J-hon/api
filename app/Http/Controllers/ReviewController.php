<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ReviewRequest;
use App\Http\Resources\ReviewResource;
use Illuminate\Support\Facades\Auth;
use App\Product;
use App\Review;

class ReviewController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api')->except('index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\ReviewResourceCollection
     */
    public function index(Product $product)
    {
        return ReviewResource::collection($product->reviews);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\ReviewRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ReviewRequest $request, Product $product)
    {

        $user = Auth::user();

        $review = Review::firstOrCreate([
            'user_id' => $user->id,
            'product_id' => $product->id,
            'rating' => $request->rating,
            'title' => $request->title,
            'description' => $request->description
        ]);

        $product->reviews()->save($review);

        return response([
            'data' => new ReviewResource($review)
        ], 201);
    }

}
