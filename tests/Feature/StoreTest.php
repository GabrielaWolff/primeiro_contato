<?php

namespace Tests\Feature;

use App\Models\Store;
use App\Models\User;
use Tests\TestCase;

class StoreTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_index_store_return_200()
    {
        $response = $this->getJson('api/stores');
        $response->assertStatus(200);
    }

     public function test_update_store_return_200()
    {
        
        $user = User::factory()->create();
        $store = Store::factory()->create([
            'user_id' => $user->id
        ]); 
        $response = $this->put("api/store/{$store->id}", $store->toArray());
        $response->assertStatus(200);
  
    } 

    public function test_store_store_return_201()
    {
        $user = User::factory()->create();
        $payload = Store::factory()->make([
            'user_id' => $user->id,

        ])->toArray();
        $response = $this->post("api/stores/", $payload); //cria um store
        $response->assertStatus(201);

    }

    public function test_show_store_return_201()
    {
        $user = User::factory()->create();
        $store = Store::factory()->create([
            'user_id' => $user->id

         ]);
        $response = $this->getJson("api/store/{$store->id}");
        $response->assertStatus(200);
    }

    public function test_delete_store_return_204()
    {
        $user = User::factory()->create();
        $store = Store::factory()->create([
            'user_id' => $user->id

         ]);

        $response = $this->delete("api/store/{$store->id}");
        $response->assertStatus(204);

    }

    public function test_store_store_with_missing_data_return_422()
    {
        $payload = []; 
        $request = $this->post('api/stores', $payload);
        $request->assertStatus(422);
    }

    public function  test_update_store_with_missing_data_return_422()
    {
        $payload = []; 
        $request = $this->put('api/store/{id}', $payload);
        $request->assertStatus(422);
    } 
}


