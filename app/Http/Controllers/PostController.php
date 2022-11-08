<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;

class PostController extends Controller
{
    /**
     *
     * @OA\Get(
     *     path="/api/posts",
     *     operationId="postIndex",
     *     tags={"Post"},
     *     description="Index of Post",
     *     @OA\Response(
     *     response= "default",
     *     description="Success: Array of Posts",
     *     @OA\MediaType(
     *       mediaType="text/plain",
     *         @OA\Schema(
     *           type = "array",
     *              @OA\Items(ref="#/components/schemas/PostData"),
     *           
     *         )
     *     )
     *   )
     * )
     */
    public function index(Request $request)
    {
        $posts = Post::with('tags')->get(); 
 
        return response()->json($posts, 200);
    }

    /**
     *
     * @OA\Put(
     *     path="/api/post/{id}",
     *     operationId="postUpdate",
     *     tags={"Post"},
     *     description="Update a Post",
     *     @OA\RequestBody(@OA\JsonContent(ref="#/components/schemas/PostUpdate")),
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Successful created",
     *         @OA\JsonContent(ref="#/components/schemas/CommentData"),
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
    public function update(UpdatePostRequest $request, $id)
    {   
        $post = Post::find($id);
        $data = $request->only('title', 'content','tags'); //ffiltra conteudo enviado pelo usuario
        
        $post->update($data);
        $post->tags()->sync($data['tags']);

        
        return response()->json($this->show($id),200);
    }

    /**
     *
     * @OA\Post(
     *     path="/api/posts",
     *     operationId="postStore",
     *     tags={"Post"},
     *     description="Store a Post",
     *     @OA\RequestBody(@OA\JsonContent(ref="#/components/schemas/PostStore")),
     *    
     *     @OA\Response(
     *         response=201,
     *         description="Successful created",
     *     @OA\JsonContent(ref="#/components/schemas/PostData"),
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Unprocessable entity"
     *     )
     *     
     * )
     *
     * @param  \app\Http\Requests\Post\StoreRequest  $request
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostRequest $request)
    {
        $data = $request->all();
 
        $post = Post::create($data);
        $post->tags()->attach($data['tags']);  //cria relaçoes many to many. em post attach tags
        return response()->json($post, 201);
    }

    public function show($id)
    {
        $post = Post::with('tags')->where('id', $id)->first();  

        return response()->json($post, 200);
    } 

    /**
     *
     * @OA\Delete(
     *     path="/api/post/{id}",
     *     operationId="postDelete",
     *     tags={"Post"},
     *     description="Delete Post",
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
 
        $post = Post::find($id); //post recebe id de dentro do model //find = where id first

        $post->delete();

        return response()->json($post, 204);
    }

}
