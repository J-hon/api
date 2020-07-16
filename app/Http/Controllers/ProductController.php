<?php

namespace App\Http\Controllers;

use App\Services\ProductService;
use App\Http\Requests\ProductRequest;
use App\Http\Resources\Product\ProductResource;
use App\Http\Resources\Product\ProductReviewResource;

class ProductController extends Controller
{

    /**
     * @var ProductService
     */

    private $productService;

    /**
     * ProductController constructor.
     * @param ProductService $productService
     */

    public function __construct(ProductService $productService)
    {
        $this->middleware('auth:api')->except(['index', 'show']);
        $this->productService = $productService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        $products = $this->productService->index();
        return ProductResource::collection($products);
    }

    /**
     * @param ProductRequest $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */

    public function store(ProductRequest $request)
    {
        $data = $request->all();

        try {
            $result = $this->productService->store($data);
            return response([
                'data' => new ProductResource($result)
            ], 201);
        }
        catch (\Exception $e) {
            return response([
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return ProductReviewResource
     */
    public function show($id)
    {
        $product = $this->productService->getProductById($id);
        return new ProductReviewResource($product);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\ProductRequest  $request
     * @param  int  $id
     * @return ProductResource
     */
    public function update(ProductRequest $request, $id)
    {
        $product = $this->productService->updateProduct($id, $request->all());
        return new ProductResource($product);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = $this->productService->deleteProduct($id);
        return $product;
    }
}
