<?php

namespace App\Interfaces;

interface ProductRepositoryInterface
{
    public function index();

    public function store($data);

    public function getProductById(int $id);

    public function updateProduct(object $prod, array $product);

    public function deleteProduct(object $product);
}
