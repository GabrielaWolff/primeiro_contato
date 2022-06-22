<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\User;
use Illuminate\Http\Request;

class UserArticleController extends Controller
{
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
    public function show($id)
    {
        $user = User::with('articles')->find($id);
        return response()->json($user, 200);
    }

    /**
     * POST
     * Create a Article that belongs to the user with
     * the id provided
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
     * PUT
     * Update a Article that has to belong to the user with
     * the id provided
     * You must check if the Article found belongs to the user (permission)
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
     * DELETE
     * delete a Article that has to belong to the user with
     * the id provided
     * You must check if the Article found belongs to the user (permission)
     */
    public function delete($id, $articleId)
    {
        $user = User::find($id);
        $article = $user->articles()->where('id', $articleId)->first();
        $article->delete();

        return response()->json($article, 200);
    }
}
