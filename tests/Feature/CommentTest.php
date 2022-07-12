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
        $comment = Comment::factory()->create();
        $response = $this->put("api/comments/{$comment->id}", $comment->toArray());
        $response->assertStatus(200);
    }
}
