<?php

namespace Tests\Feature;

use App\Models\Article;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CommentTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_index_comment_return_200()
    {
        $response = $this->getJson('api/comments');
        $response->assertStatus(200);
    }

    public function test_update_comment_return_200()
    {
        $user = User::factory()->create();
        $article = Article::factory()->create([  
            'user_id' => $user->id,
    ]);
        $comment = Comment::factory()->create([
            'user_id' => $user->id,
            'article_id' => $article->id
        ]);
        $response = $this->put("api/comment/{$comment->id}", $comment->toArray());
        $response->assertStatus(200);
    }

    public function test_store_comment_return_201()
    {
        $user = User::factory()->create();
        $article = Article::factory()->create([
            'user_id' => $user->id,
        ]);
        $payload = Comment::factory()->make([
            'user_id' => $user->id,
            'article_id' => $article->id
        ])->toArray();
        $response = $this->post('api/comments', $payload);
	    $response->assertStatus(201);

    }

    public function test_show_comment_return_200()
    {
        $user = User::factory()->create();
        $article = Article::factory()->create([
            'user_id' => $user->id,
        ]);
        $comment = Comment::factory()->create([
            'user_id' => $user->id,
            'article_id' => $article->id
        ]);
        $response = $this->getJson("api/comment/{$comment->id}");
        $response->assertStatus(200);
    }

    public function test_delete_comment_return_204()
    {
        $user = User::factory()->create();
        $article = Article::factory()->create([
            'user_id' => $user->id,
        ]);
        $comment = Comment::factory()->create([
            'user_id' => $user->id,
            'article_id' => $article->id
        ]);
        $response = $this->delete("api/comment/{$comment->id}");
        $response->assertStatus(204);
    }

    public function test_store_comment_with_missing_data_return_422()
    {
        $payload = []; 
        $request = $this->post('api/articles', $payload);
        $request->assertStatus(422);
    }

    public function test_update_comment_with_missing_data_return_422()
    {
        $payload = []; 
        $request = $this->put('api/article/{id}', $payload);
        $request->assertStatus(422);
    }
}
