<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\UpdateCommentRequest;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function _construct(Comment $comment, User $user)
    {
        $this->model = $comment;

    }

 /**
     *
     * @OA\Get(
     *     path="/api/comments",
     *     operationId="commentIndex",
     *     tags={"Comments"},
     *     description="Index of Comment",
     *     @OA\Response(
     *     response= "default",
     *     description="Success: Array of comments",
     *     @OA\MediaType(
     *       mediaType="text/plain",
     *         @OA\Schema(
     *           type = "array",
     *              @OA\Items(ref="#/components/schemas/CommentData"),
     *           
     *         )
     *     )
     *   )
     * )
     */
    public function index(Request $request)
    {
        return response()->json(Comment::all(), 200);
    }


    /**
     *
     * @OA\Put(
     *     path="/api/comment/{id}",
     *     operationId="commentUpdate",
     *     tags={"Comment"},
     *     description="Comment update",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response= "default",
     *         description="Successful operation",
     *         @OA\JsonContent(ref="#/components/schemas/CommentUpdateResponse"),
     *    )
     *     ),
     *     @OA\Parameter(
     *         name="visible",
     *         in="query",
     *         required=true,
     *         @OA\Schema(type="boolean")
     *     ),
     * 
     *     @OA\Response(
     *         response=201,
     *         description="Successful created",
     *     @OA\JsonContent(ref="#/components/schemas/CommentData"),
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
    public function update(UpdateCommentRequest $request, $id)
    {   
        $comment = Comment::find($id);
        $data = $request->only('body', 'visible'); 
        
        $comment->update($data);
        
        return response()->json($comment,200);
    }

     /**
     * @OA\Info(title="My First API", version="0.1")
     *
     * @OA\Post(
     *     path="/api/comments",
     *     operationId="comment",
     *     tags={"comment"},
     *     description="Store comment",
     *     security={{"bearer":{}}},
     *     @OA\RequestBody(@OA\JsonContent(ref="#/components/schemas/CommentStore")),
     *     @OA\Parameter(
     *         name="user_id",
     *         in="query",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Parameter(
     *         name="product_id",
     *         in="query",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Parameter(
     *         name="body",
     *         in="query",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="visible",
     *         in="query",
     *         required=true,
     *         @OA\Schema(type="boolean")
     *     ),
     * 
     *     @OA\Response(
     *         response=201,
     *         description="Successful created",
     *     @OA\JsonContent(ref="#/components/schemas/CommentData"),
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
  

    public function store(StoreCommentRequest $request)
    {
        $data = $request->all();
        $comment = Comment::create($data);

        return response()->json($comment, 201);
    }

    public function show($id)
    {
        $comments = Comment::find($id);
        return response()->json($comments, 200);
    } 

    /**
     *
     * @OA\Delete(
     *     path="/api/comment/{id}",
     *     operationId="comments",
     *     tags={"comment"},
     *     description="Delete Comments",
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
 
        $comment = Comment::find($id);

        $comment->delete();

        return response()->json($comment, 204);
    }


}