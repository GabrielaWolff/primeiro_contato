<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\Store;
use App\Models\User;
use Tests\TestCase;

class ProductTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_index_product_return_200()
    {
        $response = $this->getJson('api/products');
        $response->assertStatus(200);
    }

    public function test_update_product_return_200()
    {
         $user = User::factory()->create();
         $store = Store::factory()->create([
             'user_id' => $user->id
         ]);
         $product = Product::factory()->create([
             'store_id' => $store->id
         ]);
         $response = $this->put("api/product/{$product->id}", $product->toArray());
         $response->assertStatus(200);
    }

    public function test_product_store_return_201()
    {
        $user = User::factory()->create();
        // id, uuid, created_at, updated_at

        $store = Store::factory()->create([
            'user_id' => $user->id
        ]);

        $payload = Product::factory()->make([
            'store_id' => $store->id
        ])->toArray();

        $response = $this->post("api/products/", $payload);
        $response->assertStatus(201);

    }

    public function test_show_product_return_200()
    {
        $user = User::factory()->create();
        $store = Store::factory()->create([
            'user_id' => $user->id
        ]);
        $product = Product::factory()->create([
            'store_id' => $store->id
        ]);        $response = $this->getJson("api/product/{$product->id}");
        $response->assertStatus(200);
    }

    public function test_delete_product_return_204()
    {
        $user = User::factory()->create();
         $store = Store::factory()->create([
             'user_id' => $user->id
         ]);
         $product = Product::factory()->create([
             'store_id' => $store->id
         ]);

        $response = $this->delete("api/product/{$product->id}");
        $response->assertStatus(204);

    }

    public function test_store_product_with_missing_data_return_422()
    {
        $payload = []; 
        $request = $this->post('api/products', $payload);
        $request->assertStatus(422);
    }

    public function  test_update_product_with_missing_data_return_422()
    {
        $payload = []; 
        $request = $this->put('api/product/{id}', $payload);
        $request->assertStatus(422);
    } 
}


