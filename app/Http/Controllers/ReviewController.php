<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReviewRequest;
use App\Http\Resources\ReviewResource;
use App\Services\ReviewService;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\Review;

class ReviewController extends Controller
{

    private $reviewService;

    public function __construct(ReviewService $reviewService)
    {
        $this->reviewService = $reviewService;
        $this->middleware('auth:api')->except('index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index($id)
    {
        $reviews = $this->reviewService->getReviews($id);
        return $reviews;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\ReviewRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(ReviewRequest $request, Product $product)
    {
        $review = $this->reviewService->createReview($request->all());
        return $review;
    }

}
