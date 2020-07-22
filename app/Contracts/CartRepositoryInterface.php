<?php

namespace App\Contracts;

interface CartRepositoryInterface
{
    /**
     * @return mixed
     */
    public function getItems();

    /**
     * @param $data
     * @return mixed
     */
    public function findItem(int $id);

    /**
     * @param array $data
     * @return mixed
     */
    public function storeItems(array $data);
}
