<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Comment;
use Illuminate\Http\Request;

class ArticleCommentController extends Controller
{
    public function index()
    {
        $articles = Article::with('comments')->get();
        return $articles;
    }

    public function show($id, $commentId)
    {                     

        $article = Article::find($id);
        $comment = $article->comments()->where('id', $commentId)->first();
        
        return response()->json($comment, 200);
    }

    public function store(Request $request, $id)
    {
        $article = Article::find($id); //encontra o usuário pelo id da url
        $comment = new Comment(); //cria um novo comment dentro da variavel comment
        //dd($comment);
        $comment->body = $request->body; // comment é populado com dados da request
        $comment->visible = $request->visible;
        $comment->article_id = $article->id;
        //dd($comment);
        $comment->save();  //salva dados da article

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

    public function delete($id, $commentId)
    {
        $article = Article::find($id);
        $comment = $article->comments()->where('id', $commentId)->first();
        $comment->delete();

        return response()->json($comment, 200);
    }
}
