<?php

namespace Tests\Feature;

use App\Http\Controllers\ProductCommentController;
use App\Models\Comment;
use App\Models\Product;
use App\Models\Store;
use App\Models\User;
use Tests\TestCase;

class ProductCommentTest extends TestCase
{

    public function test_index_product_comment_return_200()
    {
        $user = User::factory()->create();
        $store = Store::factory()->create([
            'user_id' => $user->id
        ]);
        $product = Product::factory()->create([
            'store_id' => $store->id
        ]);
        $response = $this->getJson("api/product/{$product->id}/comments");
        $response->assertStatus(200);
    }

    public function test_update_product_comment_return_200()
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
        $payload = Comment::factory()->make([]);
        $response = $this->put("api/product/{$product->id}/comment/{$comment->id}", $payload->toArray());
        $response->assertStatus(200);
    }

    public function test_store_product_comment_return_200()
    {
        
        $user = User::factory()->create();
        $store = Store::factory()->create([
            'user_id' => $user->id
        ]);
        $product = Product::factory()->create([
            'store_id' => $store->id
        ]);
         
        $payload = Comment::factory()->make([
            'user_id' => $user->id,
            'product_id' => $product->id

        ]);
        //dd($payload->toArray());
        $response = $this->post("api/product/{$product->id}/comment", $payload->toArray());
        $response->assertStatus(200);
    }

    public function test_show_product_comment_return_200()
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
        $response = $this->getJson("api/product/{$product->id}/comment/{$comment->id}");
        $response->assertStatus(200);
    } 
    
    public function test_delete_product_comment_return_200()
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
        $response = $this->delete("api/product/{$product->id}/comment/{$comment->id}");
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
