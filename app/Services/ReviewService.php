<?php

namespace App\Services;

use App\Http\Resources\ReviewResource;
use App\Repositories\ReviewRepository;

class ReviewService
{

    /**
     * @var ReviewRepository
     */
    private $reviewRepository;

    /**
     * ReviewService constructor.
     * @param ReviewRepository $reviewRepository
     */
    public function __construct(ReviewRepository $reviewRepository)
    {
        $this->reviewRepository = $reviewRepository;
    }

    /**
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function getReviews($id)
    {
        $reviews = $this->reviewRepository->getAll($id);
        return ReviewResource::collection($reviews);
    }

    /**
     * @param $data
     * @return \Illuminate\Http\JsonResponse
     */
    public function createReview($data)
    {
        $review = $this->reviewRepository->store($data);
        return response()->json([
            'message' => 'Review added',
            'data' => new ReviewResource($review)
        ], 200);
    }
}
