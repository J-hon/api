<?php

namespace App\Repositories;

use App\Interfaces\ProductRepositoryInterface;
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

    public function index()
    {
        return $this->product->paginate(9);
    }

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

    public function getProductById(int $id)
    {
        $this->product = $this->product->where('id', $id)->first();
        return $this->product;
    }

    public function updateProduct(object $prod, array $product)
    {
        return $prod->update($product);
    }

    public function deleteProduct(object $product)
    {
        return $product->delete();
    }
}
