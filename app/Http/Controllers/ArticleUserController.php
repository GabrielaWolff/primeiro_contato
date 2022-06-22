<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ArticleUserController extends Controller
{
    public function index(Request $request)
    {
        $articles = Article::with('user')->get();
        return $articles;
    }
}
