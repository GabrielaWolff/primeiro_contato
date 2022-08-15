<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;

class Post extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return response()->json(Post::all(), 200);
    }

    public function update(UpdatePostRequest $request, $id)
    {   
        $post = Post::find($id);
        $data = $request->only('body', 'visible'); 
        
        $post->update($data);
        
        return response()->json($post,200);
    }

    public function store(StorePostRequest $request)
    {
        $data = $request->all();
        $post = Post::create($data);

        return response()->json($post, 201);
    }

    public function show($id)
    {
        $post = Post::find($id);
        return response()->json($post, 200);
    } 

    public function delete($id)
    {
 
        $post = Post::find($id);

        $post->delete();

        return response()->json($post, 204);
    }

}
