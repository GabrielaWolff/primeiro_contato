<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreArticleRequest;
use App\Http\Requests\UpdateArticleRequest;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    protected $model;

    public function __construct(Article $article)
    {
        $this->model = $article;
    }

    /**
     *
     * @OA\Get(
     *     path="/api/articles",
     *     operationId="articleIndex",
     *     tags={"Article"},
     *     description="Index of Article",
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
    public function index(Request $request)
    {
         
        return response()->json(Article::all(), 200);
    }

    public function show($id)
    {
        $articles = $this->model->find($id);
        return response()->json($articles, 200);
    }

    /**
     *
     * @OA\Post(
     *     path="/api/articles",
     *     operationId="articletStore",
     *     tags={"Article"},
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
     * @param  \app\Http\Requests\Article\StoreRequest  $request
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */


    public function store(StoreArticleRequest $request)
    {
        
        $data = $request->validated();
        //return $data;
	    $article = Article::create($data);
        return response()->json($this->index($request), 201);
    }
  
    /**
     *
     * @OA\Put(
     *     path="/api/article/{id}",
     *     operationId="articleUpdate",
     *     tags={"Article"},
     *     description="Update a Article",
     *     @OA\RequestBody(@OA\JsonContent(ref="#/components/schemas/ArticleUpdate")),
     *     @OA\Parameter(
     *         name="uuid",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(ref="#/components/schemas/CommentData"),
     *         
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Unprocessable entity"
     *     )
     * )
     */
    public function update(UpdateArticleRequest $request, $id)
    {
        
        $article = Article::find($id);
        $data = $request->only('name', 'slug','order'); 
  
        $article->update($data);
        
        return response()->json($article,200); 
    }


    /**
     *
     * @OA\Delete(
     *     path="/api/article/{id}",
     *     operationId="articleDelete",
     *     tags={"Article"},
     *     description="Delete Article",
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

        $article = Article::find($id);

        $article->delete();

        return response()->json($article, 204);
    }
}
