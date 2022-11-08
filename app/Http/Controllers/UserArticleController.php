<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\User;
use Illuminate\Http\Request;

class UserArticleController extends Controller
{
    /**
     *
     * @OA\Get(
     *     path="/api/userarticles",
     *     operationId="userarticleIndex",
     *     tags={"UserArticle"},
     *     description="Index of UserArticle",
     *     @OA\Response(
     *     response= "default",
     *     description="Success: Array of Articles",
     *     @OA\MediaType(
     *       mediaType="text/plain",
     *         @OA\Schema(
     *           type = "array",
     *              @OA\Items(ref="#/components/schemas/ArticleData"),
     *           
     *         )
     *     )
     *   )
     * )
     */
    public function index()
    {
        $users = User::with('articles')->get();
        return $users;
    }

    /**
     * GET
     * Returns a single user with a list of articles
     * that user has
     */
    public function show($id, $articleId)
    {
        $user = User::find($id);
        $article = $user->articles()->where('id', $articleId)->first();
        
        return response()->json($article, 200);
    }

   /**
     *
     * @OA\Post(
     *     path="/api/userarticles",
     *     operationId="userarticleStore",
     *     tags={"UserArticle"},
     *     description="Store a Article",
     *     @OA\RequestBody(@OA\JsonContent(ref="#/components/schemas/ArticleStore")),
     *    
     *     @OA\Response(
     *         response=201,
     *         description="Successful created",
     *     @OA\JsonContent(ref="#/components/schemas/ArticleData"),
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
    public function store(Request $request, $id)
    {
        $user = User::find($id); //encontra o usuário pelo id da url
        $article = new Article(); //cria um novo artigo dentro da variavel article
        $article->name = $request->name; // article é populada com dados da request
        $article->slug = $request->slug;
        $article->order = $request->order;
        $article->user_id = $user->id;
        $article->save();  //salva dados da article

        return response()->json($article, 200); //

    }

     /**
     *
     * @OA\Put(
     *     path="/api/userarticles/{id}/{articleId}",
     *     operationId="userarticleUpdate",
     *     tags={"UserArticle"},
     *     description="Update a Article",
     *     @OA\RequestBody(@OA\JsonContent(ref="#/components/schemas/ArticleUpdate")),
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Successful created",
     *         @OA\JsonContent(ref="#/components/schemas/ArticleData"),
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
    public function update(Request $request, $id, $articleId)
    {

        $user = User::find($id);
        $article = $user->articles()->where('id', $articleId)->first();
        $article->name = $request->name;
        $article->slug = $request->slug;
        $article->order = $request->order;
        $article->save();

        return response()->json($article, 200);

    }
    
    /**
     *
     * @OA\Delete(
     *     path="/api/userarticle/{id}",
     *     operationId="userarticleDelete",
     *     tags={"UserArticle"},
     *     description="Delete UserArticle",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Parameter(
     *         name="articleid",
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

    public function delete($id, $articleId)
    {
        $user = User::find($id);
        $article = $user->articles()->where('id', $articleId)->first();
        $article->delete();

        return response()->json($article, 200);
    }
}
