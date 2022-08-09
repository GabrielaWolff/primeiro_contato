<?php

namespace Tests\Feature;

use App\Models\Article;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ArticleTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_index_article_return_200()
    {
        $response = $this->getJson('api/articles');
        $response->assertStatus(200);
    }

    public function test_update_article_return_200()
    {
        $user = User::factory()->create();
        $article = Article::factory()->create([
            'user_id' => $user->id
        ]);
        $response = $this->put("api/article/{$article->id}", $article->toArray());
        $response->assertStatus(200);
    }

    public function test_store_article_return_201()
    {
         $user = User::factory()->create();
        $payload =  Article::factory()->make([
            'user_id' => $user->id
        ])->toArray();
        $response = $this->post('api/articles', $payload);
	$response->assertStatus(201);

    }

    public function test_show_article_return_200()
    {
        $user = User::factory()->create();
        $article = Article::factory()->create([
            'user_id' => $user->id
        ]);
        $response = $this->getJson("api/articles/{$article->id}");
        $response->assertStatus(200);
    }

    public function test_delete_article_return_204()
    {
        $user = User::factory()->create();
        $article = Article::factory()->create([
            'user_id' => $user->id
        ]);
        $response = $this->delete("api/article/{$article->id}");
        $response->assertStatus(204);
    }

    public function test_store_article_with_missing_data_return_422()
    {
        $payload = []; 
        $request = $this->post('api/articles', $payload);
        $request->assertStatus(422);
    }

    public function  test_update_article_with_missing_data_return_422()
    {
        $payload = []; 
        $request = $this->put('api/article/{id}', $payload);
        $request->assertStatus(422);
    }  
}


