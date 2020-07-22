<?php

namespace App\Repositories;

use App\Contracts\ReviewRepositoryInterface;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;

class ReviewRepository implements ReviewRepositoryInterface
{

    /**
     * @var Review
     */
    private $review;

    /**
     * ReviewRepository constructor.
     * @param Review $review
     */
    public function __construct(Review $review)
    {
        $this->review = $review;
    }

    /**
     * @return mixed
     */
    public function getAll($id)
    {
        $reviews = $this->review->where('product_id', $id)->latest()->get();
        return $reviews;
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function store(array $data)
    {
        $user = Auth::user();
        $review = new $this->review;

        $review->title = $data['title'];
        $review->description = $data['description'];
        $review->rating = $data['rating'];
        $review->user_id = $user->id;
        $review->product_id = $data['product_id'];

        $review->save();
        return $review;
    }
}
