<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductCommentController extends Controller
{
    
    /**
     *
     * @OA\Get(
     *     path="/api/productcomments",
     *     operationId="productcommentIndex",
     *     tags={"ProductComment"},
     *     description="Index of ProductComment",
     *     @OA\Response(
     *     response= "default",
     *     description="Success: Array of Comments",
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

    public function index($id)
    {

        $product = Product::find($id);
        return $product->comments;
    }

    public function show($id, $commentId)
    {

        $product = Product::find($id);
        $comment = $product->comments()->where('id', $commentId)->first();
        
        return response()->json($comment, 200);
    }

    public function store(Request $request, $id)
    {
        $product = Product::find($id); //encontra o produto pelo id da url
        $comment = new Comment(); //cria um novo comment dentro da variavel comment
        
        //dd($comment);
        $comment->body = $request->body; // comment é populado com dados da request
        $comment->visible = $request->visible;
        $comment->product_id = $product->id;
        //dd($comment);
        $comment->user_id = $request->user_id;

        $comment->save();  //salva dados do comment

        return response()->json($comment, 200); //

    }

    public function update(Request $request, $id, $commentId)
    {
        $product = Product::find($id);
        $comment = $product->comments()->where('id', $commentId)->first();
        $comment->body = $request->body;
        $comment->visible = $request->visible;
        $comment->save();

        return response()->json($comment, 200);

    } 

    /**
     *
     * @OA\Delete(
     *     path="/api/productcomment/{id}",
     *     operationId="productcommentDelete",
     *     tags={"productcomment"},
     *     description="Delete ProductComment",
     *     security={{"bearer":{}}},
     *     @OA\Parameter(
     *         name="commentid",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
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
    public function delete($id, $commentId)
    {
        $product = Product::find($id);
        $comment = $product->comments()->where('id', $commentId)->first();
        $comment->delete();

        return response()->json($comment, 200);
    }  
}
