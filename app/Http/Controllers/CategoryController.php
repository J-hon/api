<?php

namespace App\Http\Controllers;

use App\Http\Resources\CategoryResource;
use App\Models\Product;
use App\Models\Category;

class CategoryController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        $categories = Category::all();
        return CategoryResource::collection($categories);
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function show()
    {
        $products = Product::where('category_id', request()->id)
                    ->latest()
                    ->paginate(9);

        return response()->json([
            'data' => new CategoryResource($products)
        ]);
    }
}
