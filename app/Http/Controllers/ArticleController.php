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
    public function index(Request $request)
    {
         
        return response()->json(Article::all(), 200);
    }

    public function show($id)
    {
        $articles = $this->model->find($id);
        return response()->json($articles, 200);
    }

    public function store(StoreArticleRequest $request)
    {
        
        $data = $request->validated();
        //return $data;
	    $article = Article::create($data);
        return response()->json($this->index($request), 201);
    }
  
    public function update(UpdateArticleRequest $request, $id)
    {
        
        $article = Article::find($id);
        $data = $request->only('name', 'slug','order'); 
  
        $article->update($data);
        
        return response()->json($article,200); 
    }

    public function delete($id)
    {

        $article = Article::find($id);

        $article->delete();

        return response()->json($article, 204);
    }
}
