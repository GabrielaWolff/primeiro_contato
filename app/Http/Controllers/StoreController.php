<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStoreRequest;
use App\Http\Requests\UpdateStoreRequest;
use App\Models\Store;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    public function _construct(Store $product)
    {
       // $this->model = $store;

    }

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

    public function delete($id)
    {
 
        $store = Store::find($id);

        $store->delete();

        return response()->json($store, 204);
    }
}
