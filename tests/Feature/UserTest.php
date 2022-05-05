<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Str;

class UserTest extends TestCase
{
    use WithFaker;

    /**
     * A basic feature test example.
     *
     * @return void
     */

    public function test_index_user_return_200()
    {
        User::factory()->count(10)->create();
        $response = $this->getJson('api/users');
        $response->assertJsonStructure([
            '*' => [
                'id', 'name',
            ]
        ]);
        $response->assertStatus(200);
    }

    public function test_store_user_return_200()
    {
        $email = $this->faker->unique()->safeEmail();
        $payload = [
            'name' => $this->faker->name(),
            'email' => $email,
            'password' => Str::random(10), // password

        ];
        $response = $this->post('api/users', $payload);
        $response->assertStatus(200);
        $this->assertDatabaseHas('users', [
            'email' => $email,
        ]);
    }

    public function test_update_user_return_200()
    {
        $user = User::factory()->create();
        $email = $this->faker->unique()->safeEmail();
        $payload = [
            'name' => $this->faker->name(),
            'email' => $email,
            'password' => Str::random(10), // password

        ];
        $response = $this->put("api/users/{$user->id}", $payload);
        $response->assertStatus(200);
        $this->assertDatabaseHas('users', [
            'email' => $email,
        ]);
    }

    public function test_show_user_return_200()
    {
        $email = $this->faker->unique()->safeEmail();
        $user = User::factory()->create([
            'email' => $email
        ]);

        $response = $this->getJson("api/users/{$user->id}");
        $response->assertStatus(200);
        $this->assertDatabaseHas('users', [
            'email' => $email,
        ]);
    }

    public function test_delete_user_return_200()
    {
        $email = $this->faker->unique()->safeEmail();
        $user = User::factory()->create([
            'email' => $email
        ]);

        $response = $this->delete("api/users/{$user->id}");
        $response->assertStatus(204);
        $this->assertDatabaseMissing('users', [
            'email' => $email,
        ]);
    }
}
