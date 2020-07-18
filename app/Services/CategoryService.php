<?php

namespace App\Services;

use App\Http\Resources\CategoryProductsResource;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\Product\ProductResource;
use App\Repositories\CategoryRepository;

class CategoryService
{

    /**
     * @var CategoryRepository
     */
    private $categoryRepository;

    /**
     * CategoryService constructor.
     * @param CategoryRepository $categoryRepository
     */
    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function getAll()
    {
        $categories = $this->categoryRepository->getAllCategories();
        return CategoryResource::collection($categories);
    }

    public function getProducts($id)
    {
        $products = $this->categoryRepository->getProducts($id);

        return response()->json([
            'data' => ProductResource::collection($products)
        ]);
    }

}
