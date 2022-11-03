<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ArticleUserController extends Controller
{
    /**
     *
     * @OA\Get(
     *     path="/api/articleusers",
     *     operationId="articleuserIndex",
     *     tags={"ArticleUser"},
     *     description="Index of ArticleUser",
     *     @OA\Response(
     *     response= "default",
     *     description="Success: Array of Articles",
     *     @OA\MediaType(
     *       mediaType="text/plain",
     *         @OA\Schema(
     *           type = "array",
     *              @OA\Items(ref="#/components/schemas/UserData"),
     *           
     *         )
     *     )
     *   )
     * )
     */
    public function index(Request $request)
    {
        $articles = Article::with('user')->get();
        return $articles;
    }
}
