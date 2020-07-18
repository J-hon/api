<?php

namespace App\Repositories;

use App\Models\Category;
use App\Models\Product;

class CategoryRepository
{

    private $category;

    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    public function getAllCategories()
    {
        $categories = $this->category->get();
        return $categories;
    }

    public function getProducts(int $id)
    {
        $category = Product::where('category_id', $id)->latest()->paginate(9);
        return $category;
    }
}
