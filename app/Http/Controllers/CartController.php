<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Requests\CartRequest;
use App\Http\Resources\CartResource;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;

class CartController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        $user = Auth::user();
        $cart = Cart::where('user_id', $user->id)
                    ->orderBy('created_at', 'desc')
                    ->paginate(6);

        return CartResource::collection($cart);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CartRequest $request)
    {
        $cart = new Cart;
        $user = Auth::user();

        $cart->user_id = $user->id;
        $cart->product_id = $request->product_id;

        if (isset($cart->user_id) and isset($cart->product_id)) {
            return response()->json([
                'data' => 'Item already exists in cart.'
            ], 409);
        }

        $cart->save();

        return response()->json([
            'data' => new CartResource($cart)
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return response()->json([
            'message' => 'Deleted'
        ], 204);
    }
}
