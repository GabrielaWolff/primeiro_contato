<?php

namespace Tests\Feature;

use App\Models\Article;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserArticleTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */

    public function test_index_user_article_return_200()
    {
        $response = $this->getJson('api/userarticles');
        $response->assertStatus(200);
    }

    public function test_update_user_article_return_200()
    {
        $user = User::factory()->create();
        $userArticle = Article::factory()->create([
            'user_id' => $user->id
        ]);
        $response = $this->put("api/userarticles/{$userArticle->user_id}/{$userArticle->id}", $userArticle->toArray());
        $response->assertStatus(200);
    }


    public function test_store_user_article_return_200()
    {
        $user = User::factory()->create();
        $payload = Article::factory()->make([])->toArray();
        $response = $this->post("api/userarticles/{$user->id}", $payload);
        $response->assertStatus(200);

    }

    public function test_show_user_article_return_200()
    {
        $user = User::factory()->create();
        $userArticle = Article::factory()->create([
            'user_id' => $user->id
        ]);
        $response = $this->getJson("api/userarticles/{$user->id}/{$userArticle->id}");
        $response->assertStatus(200);
    }

    public function test_delete_user_article_return_200()
    {
        $user = User::factory()->create();
        $userArticle = Article::factory()->create([
            'user_id' => $user->id
        ]);
        $response = $this->delete("api/userarticles/{$user->id}/{$userArticle->id}");
        $response->assertStatus(200);
    }

}
