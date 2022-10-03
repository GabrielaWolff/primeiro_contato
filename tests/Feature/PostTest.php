<?php

namespace Tests\Feature;

use App\Models\Article;
use App\Models\User;
use App\Models\Post;
use App\Models\Tag;
use Tests\TestCase;

class PostTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_index_post_return_200()
    {
        $response = $this->getJson('api/posts');
        $response->assertStatus(200);
    }

    public function test_update_post_return_200()
    {
        $user = User::factory()->create();
        $post = Post::factory()->create([
            'user_id' => $user->id
        ]);
        $response = $this->put("api/post/{$post->id}", $post->toArray());
        $response->assertStatus(200);
    }

    public function test_store_post_return_201()
    {
        $post = Post::factory()->create();
        $tag = Tag::factory()->create();
        $user = User::factory()->create();
        $payload =  Post::factory()->make([
            'user_id' => $user->id,
            'title' => $tag->title,
            'content' => $tag->content,
            'tags'=>  $post->tags,//vetor de id que associa a post, associativo
        ])->toArray(); //converte obj to array
        $response = $this->post('api/posts', $payload);
        $response->assertStatus(201);

    }

    public function test_show_post_return_200()
    {
        $user = User::factory()->create();
        $post = Post::factory()->create([
            'user_id' => $user->id
        ]);
        $response = $this->getJson("api/post/{$post->id}");
        $response->assertStatus(200);
    }

    public function test_post_article_return_204()
    {
        $user = User::factory()->create();
        $article = Article::factory()->create([
            'user_id' => $user->id
        ]);
        $response = $this->delete("api/post/{$article->id}");
        $response->assertStatus(204);
    }

    public function test_store_post_with_missing_data_return_422()
    {
        $payload = []; 
        $request = $this->post('api/posts', $payload);
        $request->assertStatus(422);
    }

    public function  test_update_post_with_missing_data_return_422()
    {
        $payload = []; 
        $request = $this->put('api/post/{id}', $payload);
        $request->assertStatus(422);
    }  
}


