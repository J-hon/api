<?php

namespace App\Repositories;

use App\Contracts\CartRepositoryInterface;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

class CartRepository implements CartRepositoryInterface
{

    /**
     * @var Cart
     */
    private $cart;

    /**
     * CartRepository constructor.
     * @param Cart $cart
     */
    public function __construct(Cart $cart)
    {
        $this->cart = $cart;
    }

    /**
     * @return mixed
     */
    public function getItems()
    {
        $user = Auth::user();
        $cart = $this->cart->where('user_id', $user->id)
                           ->orderBy('created_at', 'desc')
                           ->paginate(6);

        return $cart;
    }

    /**
     * @param $data
     * @return mixed
     */
    public function findItem(int $id)
    {
        $user = Auth::user();

        $exists = $this->cart->where('product_id', $id)
                             ->where('user_id', $user->id)
                             ->first();
        return $exists;
    }

    /**
     * @param $data
     * @return mixed
     */
    public function storeItems(array $data)
    {
        $user = Auth::user();
        $cart = new $this->cart;

        $cart->user_id = $user->id;
        $cart->product_id = $data['product_id'];

        $cart->save();
        return $cart;
    }
}
