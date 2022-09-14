<?php

namespace App\Http\Controllers;

use App\Models\Tag;

class TagPostController extends Controller
{ 
    public function show($id)
    {       
        $tag = Tag::find($id); //garantir q id da tag existe

        $posts = $tag->posts()->get();//pega os posts que pertencem a tag

        return response()->json($posts, 200);
    } 
}
