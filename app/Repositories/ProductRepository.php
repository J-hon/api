<?php

namespace App\Repositories;

use App\Contracts\ProductRepositoryInterface;
use App\Models\Product;

class ProductRepository implements ProductRepositoryInterface
{

    /**
     * @var Product
     */
    protected $product;

    /**
     * ProductRepository constructor.
     *
     * @param Product $product
     */

    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    /**
     * @return mixed
     */
    public function index()
    {
        return $this->product->paginate(9);
    }

    /**
     * @param $data
     * @return mixed
     */
    public function store($data)
    {
        $product = new $this->product;

        $product->name = $data['name'];
        $product->code = $data['code'];
        $product->slug = $data['slug'];
        $product->description = $data['description'];
        $product->price = $data['price'];
        $product->category_id = $data['category_id'];

        $product->save();
        return $product;
    }

    /**
     * @param int $id
     * @return Product
     */
    public function getProductById(int $id)
    {
        $product = $this->product->where('id', $id)->first();
        return $product;
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
