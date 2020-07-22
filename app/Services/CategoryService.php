<?php

namespace App\Services;

use App\Contracts\CategoryRepositoryInterface;
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
     * @param CategoryRepositoryInterface $categoryRepository
     */
    public function __construct(CategoryRepositoryInterface $categoryRepository)
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
