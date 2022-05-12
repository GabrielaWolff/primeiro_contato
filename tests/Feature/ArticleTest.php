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
       	$article = Article::factory()->make();
	dd($article);
        // $response = $this->getJson('api/articles');
        // $response->assertStatus(200);
    }
}
