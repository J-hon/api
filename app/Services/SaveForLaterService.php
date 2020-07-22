<?php

namespace App\Services;

use App\Contracts\SaveForLaterRepositoryInterface;
use App\Http\Resources\SaveForLaterResource;
use App\Repositories\SaveForLaterRepository;

class SaveForLaterService
{

    /**
     * @var SaveForLaterRepository
     */
    private $saveForLaterRepository;

    /**
     * SaveForLaterService constructor.
     * @param SaveForLaterRepository $saveForLaterRepository
     */
    public function __construct(SaveForLaterRepositoryInterface $saveForLaterRepository)
    {
        $this->saveForLaterRepository = $saveForLaterRepository;
    }

    /**
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function getItems()
    {
        $item = $this->saveForLaterRepository->getItems();
        return SaveForLaterResource::collection($item);
    }

    /**
     * @param $data
     * @return SaveForLaterResource|\Illuminate\Http\JsonResponse
     */
    public function storeItems($data)
    {
        $exists = $this->saveForLaterRepository->findItem($data['product_id']);

        if ($exists) {
            return response()->json([
                'message' => 'Item already exists in cart.'
            ], 409);
        }

        $item = $this->saveForLaterRepository->addToSaveForLater($data);
        return $item;
    }

    public function deleteItem(int $id)
    {
        $item = $this->saveForLaterRepository->getProductById($id);

        if (!$item)
        {
            return response()->json([
                'message' => 'Product Not Found'
            ], 404);
        }

        $this->saveForLaterRepository->deleteItem($item);
        return response()->json([
            'message' => 'Product removed from Save For Later!'
        ], 200);
    }
}
