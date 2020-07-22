<?php

namespace App\Repositories;

use App\Contracts\SaveForLaterRepositoryInterface;
use App\Models\SaveForLater;
use Illuminate\Support\Facades\Auth;

class SaveForLaterRepository implements SaveForLaterRepositoryInterface
{

    /**
     * @var SaveForLater
     */
    private $saveForLater;

    /**
     * SaveForLaterRepository constructor.
     * @param SaveForLater $saveForLater
     */
    public function __construct(SaveForLater $saveForLater)
    {
        $this->saveForLater = $saveForLater;
    }

    /**
     * @return mixed
     */
    public function getItems()
    {
        $user = Auth::user();
        $items = $this->saveForLater->where('user_id', $user->id)
                                    ->orderBy('created_at', 'desc')
                                    ->paginate(6);

        return $items;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function findItem(int $id)
    {
        $user = Auth::user();
        $exists = $this->saveForLater->where('product_id', $id)
                                     ->where('user_id', $user->id)
                                     ->first();

        return $exists;
    }

    /**
     * @param int $id
     * @return SaveForLater
     */
    public function getProductById(int $id)
    {
        $product = $this->saveForLater->where('id', $id)->first();
        return $product;
    }

    /**
     * @param $data
     * @return mixed
     */
    public function addToSaveForLater($data)
    {
        $user = Auth::user();
        $saveForLater = new $this->saveForLater;

        $saveForLater->user_id = $user->id;
        $saveForLater->product_id = $data['product_id'];

        $saveForLater->save();
        return $saveForLater;
    }

    /**
     * @param object $product
     * @return mixed
     */
    public function deleteItem(object $product)
    {
        return $product->delete();
    }
}
