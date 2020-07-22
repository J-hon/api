<?php

namespace App\Repositories;

use App\Contracts\CategoryRepositoryInterface;
use App\Models\Category;
use App\Models\Product;

class CategoryRepository implements CategoryRepositoryInterface
{

    /**
     * @var Category
     */
    private $category;

    /**
     * CategoryRepository constructor.
     * @param Category $category
     */
    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    /**
     * @return mixed
     */
    public function getAllCategories()
    {
        $categories = $this->category->get();
        return $categories;
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function getProducts(int $id)
    {
        $category = Product::where('category_id', $id)->latest()->paginate(9);
        return $category;
    }
}
