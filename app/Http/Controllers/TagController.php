<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Http\Requests\StoreTagRequest;
use App\Http\Requests\UpdateTagRequest;
use Illuminate\Http\Request;


class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return response()->json(Tag::all(), 200);
    }

    public function update(UpdateTagRequest $request, $id)
    {   
        $tag = Tag::find($id);
        $data = $request->only('body', 'visible'); 
        
        $tag->update($data);
        
        return response()->json($tag,200);
    }

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
     *     tags={"comment"},
     *     description="Delete tag",
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
 
        $tag = Tag::find($id);

        $tag->delete();

        return response()->json($tag, 204);
    }

}
