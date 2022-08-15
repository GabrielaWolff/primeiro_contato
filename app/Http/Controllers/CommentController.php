<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\UpdateCommentRequest;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function _construct(Comment $comment, User $user)
    {
        $this->model = $comment;

    }

    public function index(Request $request)
    {
        return response()->json(Comment::all(), 200);
    }

    public function update(UpdateCommentRequest $request, $id)
    {   
        $comment = Comment::find($id);
        $data = $request->only('body', 'visible'); 
        
        $comment->update($data);
        
        return response()->json($comment,200);
    }

    public function store(StoreCommentRequest $request)
    {
        $data = $request->all();
        $comment = Comment::create($data);

        return response()->json($comment, 201);
    }

    public function show($id)
    {
        $comments = Comment::find($id);
        return response()->json($comments, 200);
    } 

    public function delete($id)
    {
 
        $comment = Comment::find($id);

        $comment->delete();

        return response()->json($comment, 204);
    }


}