<?php

namespace App\Services;

use App\Repositories\ProductRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use InvalidArgumentException;

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
    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function index()
    {
        return $this->productRepository->index();
    }

    public function store($data)
    {
        $result = $this->productRepository->store($data);
        return $result;
    }

    /**
     * @param int $id
     * @return \App\Product
     */
    public function getProductById(int $id)
    {
        return $this->productRepository->getProductById($id);
    }

    /**
     * @param int $id
     * @param array $product
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function updateProduct(int $id, array $product)
    {
        $prod = $this->productRepository->getProductById($id);

        if (!$prod) {
            return response([
                'message' => 'Product Not Found'
            ], 404);
        }

        $this->productRepository->updateProduct($prod, $product);
        return response([
            'message' => 'Product Updated'
        ], 200);
    }

    /**
     * @param int $id
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function deleteProduct(int $id)
    {
        $prod = $this->productRepository->getProductById($id);

        if (!$prod) {
            return response([
                'message' => 'Product Not Found'
            ], 404);
        }

        $this->productRepository->deleteProduct($prod);
        return response([
            'message' => 'Product Deleted'
        ], 200);
    }
}
