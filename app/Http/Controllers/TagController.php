<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Http\Requests\StoreTagRequest;
use App\Http\Requests\UpdateTagRequest;
use Illuminate\Http\Request;


class TagController extends Controller
{
    
    /**
     *
     * @OA\Get(
     *     path="/api/tags",
     *     operationId="tagIndex",
     *     tags={"Tag"},
     *     description="Index of Tag",
     *     @OA\Response(
     *     response= "default",
     *     description="Success: Array of Tags",
     *     @OA\MediaType(
     *       mediaType="text/plain",
     *         @OA\Schema(
     *           type = "array",
     *              @OA\Items(ref="#/components/schemas/TagData"),
     *           
     *         )
     *     )
     *   )
     * )
     */
    public function index(Request $request)
    {
        return response()->json(Tag::all(), 200);
    }

     /**
     *
     * @OA\Put(
     *     path="/api/tag/{id}",
     *     operationId="tagUpdate",
     *     tags={"Tag"},
     *     description="Update a Tag",
     *     @OA\RequestBody(@OA\JsonContent(ref="#/components/schemas/TagUpdate")),
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Successful created",
     *         @OA\JsonContent(ref="#/components/schemas/TagData"),
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Unprocessable entity"
     *     )
     *     
     * )
     *
     * @param  \app\Http\Requests\Comment\StoreRequest  $request
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTagRequest $request, $id)
    {   
        $tag = Tag::find($id);
        $data = $request->only('body', 'visible'); 
        
        $tag->update($data);
        
        return response()->json($tag,200);
    }

    /**
     *
     * @OA\Post(
     *     path="/api/tags",
     *     operationId="TagStore",
     *     tags={"Tag"},
     *     description="Store a Tag",
     *     @OA\RequestBody(@OA\JsonContent(ref="#/components/schemas/TagStore")),
     *    
     *     @OA\Response(
     *         response=201,
     *         description="Successful created",
     *     @OA\JsonContent(ref="#/components/schemas/TagData"),
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Unprocessable entity"
     *     )
     *     
     * )
     *
     * @param  \app\Http\Requests\Comment\StoreRequest  $request
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTagRequest $request)
    {
        $data = $request->all();
        $tag = Tag::create($data);

        return response()->json($tag, 201);
    }

    public function show($id)
    {
        $tag = Tag::find($id);
        return response()->json($tag, 200);
    } 

    /**
     *
     * @OA\Delete(
     *     path="/api/tag/{id}",
     *     operationId="tagDelete",
     *     tags={"Tag"},
     *     description="Delete tag",
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
 
        $tag = Tag::find($id);

        $tag->delete();

        return response()->json($tag, 204);
    }

}
