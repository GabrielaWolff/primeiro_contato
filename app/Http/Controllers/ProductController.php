<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function _construct(Product $product)
    {
        $this->model = $product;

    }

    /**
     *
     * @OA\Get(
     *     path="/api/products",
     *     operationId="productIndex",
     *     tags={"Product"},
     *     description="Index of Product",
     *     @OA\Response(
     *     response= "default",
     *     description="Success: Array of Products",
     *     @OA\MediaType(
     *       mediaType="text/plain",
     *         @OA\Schema(
     *           type = "array",
     *              @OA\Items(ref="#/components/schemas/ProductData"),
     *           
     *         )
     *     )
     *   )
     * )
     */
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

    /**
     *
     * @OA\Delete(
     *     path="/api/product/{id}",
     *     operationId="productDelete",
     *     tags={"product"},
     *     description="Delete Product",
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
 
        $product = Product::find($id);

        $product->delete();

        return response()->json($product, 204);
    }
}
