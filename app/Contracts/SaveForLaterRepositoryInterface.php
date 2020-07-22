<?php

namespace App\Contracts;

interface SaveForLaterRepositoryInterface
{
    /**
     * @return mixed
     */
    public function getItems();

    /**
     * @param $id
     * @return mixed
     */
    public function findItem(int $id);

    /**
     * @param $data
     * @return mixed
     */
    public function addToSaveForLater($data);

    /**
     * @param $id
     * @return mixed
     */
    public function deleteItem(object $product);

    /**
     * @param int $id
     * @return mixed
     */
    public function getProductById(int $id);

}
