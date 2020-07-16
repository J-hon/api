<?php

namespace App\Http\Controllers;

use App\Http\Resources\SearchResource;
use App\Models\Product;

class SearchController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\SearchRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function search($query)
    {
        $query = trim($query);

        $products = Product::where('name', 'like', "%$query%")
                             ->orWhere('description', 'like', "%$query%")
                             ->orWhere('price', 'like', "%$query%")
                             ->paginate(9);

        return response()->json([
            'data' => new SearchResource($products)
        ]);
    }
}
