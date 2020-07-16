<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\SaveForLaterRequest;
use App\Http\Resources\SaveForLaterResource;
use Illuminate\Support\Facades\Auth;
use App\Models\SaveForLater;

class SaveForLaterController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        $user = Auth::user();
        $cart = SaveForLater::where('user_id', $user->id)
                    ->orderBy('created_at', 'desc')
                    ->paginate(6);

        return SaveForLaterResource::collection($cart);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(SaveForLaterRequest $request)
    {
        $saveForLater = new SaveForLater;
        $user = Auth::user();

        $saveForLater->user_id = $user->id;
        $saveForLater->product_id = $request->product_id;

        $saveForLater->save();

        return response()->json([
            'data' => new SaveForLaterResource($saveForLater)
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $saveForLater = SaveForLater::findOrFail($id);
        $saveForLater->delete();

        return response()->json([
            'message' => 'Deleted'
        ], 204);
    }
}
