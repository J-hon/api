<?php

namespace App\Contracts;

interface CategoryRepositoryInterface
{
    public function getAllCategories();

    public function getProducts(int $id);
}
