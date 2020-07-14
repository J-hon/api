<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\SearchRequest;
use App\Http\Resources\SearchResource;
use App\Product;

class SearchController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\SearchRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function search($query)
    {
        // $query = $request->input(trim($query));

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
