<?php

namespace App\Http\Controllers;

use App\Http\Requests\Product\ProductUpdateRequest;
use App\Services\ProductService;
use App\Http\Requests\Product\ProductRequest;
use App\Http\Resources\Product\ProductResource;
use App\Http\Resources\Product\ProductReviewResource;

class ProductController extends BaseController
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
//        $this->middleware('auth:user');
        $this->productService = $productService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $products = $this->productService->index();
        return $this->responseJson(true, 200, '', ProductResource::collection($products));
    }

    /**
     * @param ProductRequest $request
     * @return \Illuminate\Http\JsonResponse
     */

    public function store(ProductRequest $request)
    {
        $data = $this->productService->store($request->all());
        return $this->responseJson(true, 200, '', new ProductResource($data));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $product = $this->productService->getProductById($id);
        return $this->responseJson(true, 200, '', new ProductReviewResource($product));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  ProductUpdateRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(ProductUpdateRequest $request, $id)
    {
        $product = $this->productService->updateProduct($id, $request->except('code'));
        return $this->responseJson(true, 200, '', new ProductResource($product));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        return $this->productService->deleteProduct($id);
    }
}
