<?php

namespace App\Http\Controllers;

use App\Services\SaveForLaterService;
use App\Http\Requests\SaveForLaterRequest;

class SaveForLaterController extends Controller
{

    /**
     * @var SaveForLaterService
     */
    private $saveForLaterService;

    /**
     * SaveForLaterController constructor.
     * @param SaveForLaterService $saveForLaterService
     */
    public function __construct(SaveForLaterService $saveForLaterService)
    {
        $this->saveForLaterService = $saveForLaterService;
        $this->middleware('auth:api');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        return $this->saveForLaterService->getItems();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(SaveForLaterRequest $request)
    {
        $item = $this->saveForLaterService->storeItems($request->all());
        return $item;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $product = $this->saveForLaterService->deleteItem($id);
        return $product;
    }
}
