<?php

namespace Tests\Feature;

use App\Models\Article;
use App\Models\Comment;
use App\Models\Product;
use App\Models\Store;
use App\Models\User;
use Tests\TestCase;

class ArticleCommentTest extends TestCase
{
    public function test_index_article_comment_return_200()
    {
       
        $user = User::factory()->create();
        $article = Article::factory()->create([
            'user_id' => $user->id
        ]);
        $response = $this->getJson("api/article/{$article->id}/comments");
        $response->assertStatus(200);
    
    
    }
 
    public function test_update_article_comment_return_200()
    {
        $user = User::factory()->create();
        $article = Article::factory()->create([
            'user_id' => $user->id
        ]);
        $comment = Comment::factory()->create([
            'user_id' => $user->id,
            'article_id' => $article->id
        ]);
        
        $payload = Comment::factory()->make([]);
        $response = $this->put("api/article/{$article->id}/comment/{$comment->id}", $payload->toArray());
        $response->assertStatus(200);
    }


    public function test_store_article_comment_return_200()
    {
        $user = User::factory()->create();
        $payload = Article::factory()->make([])->toArray();
        $response = $this->post("api/userarticles/{$user->id}", $payload);
        $response->assertStatus(200);

    }

    public function test_show_article_comment_return_200()
    {      
        $user = User::factory()->create();
        $store = Store::factory()->create([
            'user_id' => $user->id
        ]);
        $product = Product::factory()->create([
            'store_id' => $store->id
        ]);
        $comment = Comment::factory()->create([
            'user_id' => $user->id,
            'product_id' => $product->id
        ]);
        $article = Article::factory()->create([
            'user_id' => $user->id
        ]);

        $response = $this->getJson("api/article/{$article->id}/comment/{$comment->id}");
        $response->assertStatus(200);
    }

    
    public function test_delete_product_comment_return_200()
    {
        $user = User::factory()->create();
         $article = Article::factory()->create([
            'user_id' => $user->id
        ]);
        $comment = Comment::factory()->create([
            'user_id' => $user->id,
            'article_id' => $article->id,

        ]);
       
        $response = $this->delete("api/article/{$article->id}/comment/{$comment->id}");
        $response->assertStatus(200);
    }

    public function test_store_product_comment_with_missing_data_return_422()
    {
        $payload = []; 
        $request = $this->post('api/articles', $payload);
        $request->assertStatus(422);
    }

    public function test_update_product_comment_with_missing_data_return_422()
    {
        $payload = []; 
        $request = $this->put('api/article/{id}', $payload);
        $request->assertStatus(422);
    }


}
