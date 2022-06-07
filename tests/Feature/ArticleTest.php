<?php

namespace Tests\Feature;

use App\Models\Article;
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
        $article = Article::factory()->create();
        $response = $this->put("api/articles/{$article->id}", $article->toArray());
        $response->assertStatus(200);
    }


    public function test_store_article_return_201()
    {
        $payload = Article::factory()->make([])->toArray();
        $response = $this->post('api/articles', $payload);
	$response->assertStatus(201);

    }

    public function test_show_article_return_200()
    {
        $article = Article::factory()->create();
        $response = $this->getJson("api/articles/{$article->id}");
        $response->assertStatus(200);
    }

    public function test_delete_article_return_204()
    {
        $article = Article::factory()->create();
        $response = $this->delete("api/articles/{$article->id}");
        $response->assertStatus(204);
    }
}
