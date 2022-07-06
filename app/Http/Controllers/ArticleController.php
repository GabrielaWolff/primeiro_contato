<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUpdateArticleFormRequest;
use App\Http\Requests\StoreUpdateUserFormRequest;
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

    public function store(StoreUpdateArticleFormRequest $request)
    {
        $data = $request->all();

	$article = Article::create($data);

        return response()->json($this->index($request), 201);
    }

    public function create()
    {
        return view('articles.create');
    }

    public function edit($id)
    {
        if (!$user = $this->model->find($id))
            return redirect()->route('articles.index');
        return view('articles.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        if (!$article = $this->model->find($id)) {
            return redirect()->route('articles.index');
        }
        $data = $request->only('name', 'email');
        if ($request->password) {
            $data['password'] = bcrypt($request->password);
        }
        if ($request->image) {
            if ($article->image && Storage::exists($article->image)) {
                Storage::delete($article->image);
            }

            $data['image'] = $request->image->store('users');
        }

        $article->update($data);

        return response()->json($article, 200);
    }

    public function delete($id)
    {

        if (!$article = $this->model->find($id)) {
            return response()->json([
                'error' => 'Não encontrado!'
            ], 404);
        }

        $article->delete();

        return response()->json([], 204);
    }
}
