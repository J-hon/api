<?php

namespace App\Services;

use App\Contracts\CartRepositoryInterface;
use App\Http\Resources\CartResource;
use App\Repositories\CartRepository;

class CartService
{

    /**
     * @var CartRepository
     */
    private $cartRepository;

    /**
     * CartService constructor.
     * @param CartRepositoryInterface $cartRepository
     */
    public function __construct(CartRepositoryInterface $cartRepository)
    {
        $this->cartRepository = $cartRepository;
    }

    /**
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function getItems()
    {
        $cart = $this->cartRepository->getItems();
        return CartResource::collection($cart);
    }

    /**
     * @param $data
     * @return CartResource|\Illuminate\Http\JsonResponse
     */
    public function storeItems($data)
    {
        $exists = $this->cartRepository->findItem($data['product_id']);

        if ($exists) {
            return response()->json([
                'message' => 'Item already exists in cart.'
            ], 409);
        }

        $cartItem = $this->cartRepository->storeItems($data);
        return $cartItem;
    }

}
