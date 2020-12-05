<?php

namespace App\Repositories;

use App\Contracts\ProductRepositoryInterface;
use App\Models\Product;

class ProductRepository extends BaseRepository implements ProductRepositoryInterface
{

    public function __construct(Product $model)
    {
        parent::__construct($model);
        $this->model = $model;
    }

    /**
     * @return mixed
     */
    public function index()
    {
        return $this->model->orderBy('created_at', 'DESC')->paginate(5);
    }

    /**
     * @param $data
     * @return mixed
     */
    public function store($data)
    {
        return $this->create($data);
    }

    /**
     * @param int $id
     * @return Product
     */
    public function getProductById(int $id)
    {
        return $this->find($id);
    }

    /**
     * @param object $prod
     * @param array $product
     * @return mixed
     */
    public function updateProduct(object $prod, array $product)
    {
        return $prod->update($product);
    }

    /**
     * @param object $product
     * @return mixed
     */
    public function deleteProduct(object $product)
    {
        return $product->delete();
    }
}
