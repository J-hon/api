<?php

namespace App\Http\Controllers;

use App\Http\Resources\SearchResource;
use App\Models\Product;

class SearchController extends Controller
{

    /**
     * @param $query
     * @return \Illuminate\Http\JsonResponse
     */
    public function search($query)
    {
        if ($query !== "") {
            $query = trim($query);

            $products = Product::where('name', 'like', "%$query%")
                                 ->orWhere('description', 'like', "%$query%")
                                 ->paginate(9);

            return response()->json([
                'data' => new SearchResource($products)
            ]);
        }

        return response()->json([
            'message' => "Search field can't be empty"
        ]);

//        $products = Product::search($query)->get();
//
//        return response()->json([
//            'data' => new SearchResource($products)
//        ]);
    }
}
