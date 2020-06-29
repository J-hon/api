<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\SearchRequest;
use App\Http\Resources\SearchResource;
use App\Product;

class SearchController extends Controller
{
    public function search($query)
    {
        $query = trim($query);

        $products = Product::where('name', 'like', "%{$query}%")
                             ->orWhere('description', 'like', "%{$query}%")
                             ->orWhere('price', 'like', "%{$query}%")
                             ->paginate(6);

        return response()->json([
            'data' => new SearchResource($products)
        ]);
    }
}
