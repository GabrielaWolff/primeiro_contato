<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Comment;
use Illuminate\Http\Request;

class ArticleCommentController extends Controller
{

    /**
     *
     * @OA\Get(
     *     path="/api/articlecomments",
     *     operationId="articlecommentIndex",
     *     tags={"ArticleComment"},
     *     description="Index of ArticleComment",
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

        $article = Article::find($id);
        return $article->comments;
    }

    public function show($id, $commentId)
    {

        $article = Article::find($id);
        $comment = $article->comments()->where('id', $commentId)->first();
        
        return response()->json($comment, 200);
    }

    public function store(Request $request, $id)
    {
        $article = Article::find($id); //encontra o produto pelo id da url
        $comment = new Comment(); //cria um novo comment dentro da variavel comment
        
        //dd($comment);
        $comment->body = $request->body; // comment é populado com dados da request
        $comment->visible = $request->visible;
        $comment->product_id = $article->id;
        //dd($comment);
        $comment->user_id = $request->user_id;

        $comment->save();  //salva dados do comment

        return response()->json($comment, 200); //

    }

    public function update(Request $request, $id, $commentId)
    {
        $article = Article::find($id);
        $comment = $article->comments()->where('id', $commentId)->first();
        $comment->body = $request->body;
        $comment->visible = $request->visible;
        $comment->save();

        return response()->json($comment, 200);

    } 

    /**
     *
     * @OA\Delete(
     *     path="/api/articlecomment/{id}",
     *     operationId="articlecommentDelete",
     *     tags={"articlecomment"},
     *     description="Delete ArticleComment",
     *     security={{"bearer":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Parameter(
     *         name="commentid",
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
        $article = Article::find($id);
        $comment = $article->comments()->where('id', $commentId)->first();
        $comment->delete();

        return response()->json($comment, 200);
    }  
}
