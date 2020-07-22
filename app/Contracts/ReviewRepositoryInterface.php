<?php

namespace App\Contracts;

interface ReviewRepositoryInterface
{
    /**
     * @return mixed
     */
    public function getAll($id);

    /**
     * @param array $data
     * @return mixed
     */
    public function store(array $data);
}
