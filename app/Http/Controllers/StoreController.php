<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStoreRequest;
use App\Http\Requests\UpdateStoreRequest;
use App\Models\Store;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    /*public function _construct(Store $product)
    {
       // $this->model = $store;

    }*/

    /**
     *
     * @OA\Get(
     *     path="/api/stores",
     *     operationId="storeIndex",
     *     tags={"Store"},
     *     description="Index of Store",
     *     @OA\Response(
     *     response= "default",
     *     description="Success: Array of Stores",
     *     @OA\MediaType(
     *       mediaType="text/plain",
     *         @OA\Schema(
     *           type = "array",
     *              @OA\Items(ref="#/components/schemas/StoreData"),
     *           
     *         )
     *     )
     *   )
     * )
     */
    public function index(Request $request)
    {
        return response()->json(Store::all(), 200);
    }

    public function update(UpdateStoreRequest $request, $id)
    {   
        $store = Store::find($id);
        $data = $request->only('name', 'description'); 
        
        $store->update($data);
        
        return response()->json($store,200);
    }

    public function store(StoreStoreRequest $request)
    {
        $data = $request->all();
        $store = Store::create($data);

        return response()->json($store, 201);
    }

    public function show($id)
    {
        $stores = Store::find($id);
        return response()->json($stores, 200);
    } 

    /**
     *
     * @OA\Delete(
     *     path="/api/store/{id}",
     *     operationId="storeDelete",
     *     tags={"comment"},
     *     description="Delete Store",
     *     security={{"bearer":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="No content"
     *     ),
     * 
     * )
     * 
     * Remove the specified resource from storage.
     *
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
 
        $store = Store::find($id);

        $store->delete();

        return response()->json($store, 204);
    }
}
