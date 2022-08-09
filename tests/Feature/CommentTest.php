<?php

namespace Tests\Feature;

use App\Models\Comment;
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
        $comment = Comment::factory()->create([
            'article_id' => 1
        ]);
        $response = $this->put("api/comment/{$comment->id}", $comment->toArray());
        $response->assertStatus(200);
    }

    public function test_store_comment_return_201()
    {
        $payload = Comment::factory()->make([
            'article_id' => 1
        ])->toArray();
        $response = $this->post('api/comments', $payload);
	    $response->assertStatus(201);

    }

    public function test_show_comment_return_200()
    {
        $comment = Comment::factory()->create([
            'article_id' => 1
        ]);
        $response = $this->getJson("api/comment/{$comment->id}");
        $response->assertStatus(200);
    }

    public function test_delete_comment_return_204()
    {
        $comment = Comment::factory()->create([
            'article_id' => 1
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
