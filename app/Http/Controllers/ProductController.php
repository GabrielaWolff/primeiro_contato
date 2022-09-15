<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Requests\StoreProductRequest;
use Illuminate\Http\Requests\UpdateProductRequest;

class ProductController extends Controller
{
    public function _construct(Product $product)
    {
        $this->model = $product;

    }

    public function index(Request $request)
    {
        return response()->json(Product::all(), 200);
    }

    public function update(UpdateProductRequest $request, $id)
    {   
        $product = Product::find($id);
        $data = $request->only('name', 'description','price','amount'); 
        
        $product->update($data);
        
        return response()->json($product,200);
    }

    public function store(StoreProductRequest $request)
    {
        $data = $request->all();
        $product = Product::create($data);

        return response()->json($product, 201);
    }

    public function show($id)
    {
        $products = Product::find($id);
        return response()->json($products, 200);
    } 

    public function delete($id)
    {
 
        $product = Product::find($id);

        $product->delete();

        return response()->json($product, 204);
    }
}
