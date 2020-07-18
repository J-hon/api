<?php

namespace App\Services;

use App\Repositories\ProductRepository;
use App\Interfaces\ProductRepositoryInterface;

class ProductService
{
    /**
     * @var ProductRepository
     */
    private $productRepository;

    /**
     * ProductService constructor.
     * @param ProductRepository $productRepository
     */
    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    /**
     * @return mixed
     */
    public function index()
    {
        $products =$this->productRepository->index();
        return $products;
    }

    /**
     * @param $data
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function store($data)
    {
        $product = $this->productRepository->store($data);
        return $product;
    }

    /**
     * @param int $id
     * @return \App\Models\Product
     */
    public function getProductById(int $id)
    {
        $product = $this->productRepository->getProductById($id);
        return $product;
    }

    /**
     * @param int $id
     * @param array $product
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateProduct(int $id, array $product)
    {
        $getProduct = $this->productRepository->getProductById($id);

        if (!$getProduct) {
            return response()->json([
                'message' => 'Product Not Found'
            ], 404);
        }

        $this->productRepository->updateProduct($getProduct, $product);
        return response()->json([
            'message' => 'Product Updated'
        ], 200);
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteProduct(int $id)
    {
        $prod = $this->productRepository->getProductById($id);

        if (!$prod) {
            return response()->json([
                'message' => 'Product Not Found'
            ], 404);
        }

        $this->productRepository->deleteProduct($prod);
        return response()->json([
            'message' => 'Product Deleted'
        ], 200);
    }
}
