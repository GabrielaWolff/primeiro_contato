<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PostTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_update()
    {
        $user = User::factory()->create(); //factory user
        Passport::actingAs($user, ['api']); //set passport user

        $post = Post::factory()->create(['user_id' => $user->id]); //factory kbarticle

        $data = [

        ];
        $kb = Kb::where("id",$post->kb_id)->first();
        $PostTestCase = new KbTestCase();
        $PostTestCase->assignRoleUser($kb,$user,RoleEnum::GENERAL_ADMIN);
        $this->putJson("/api/v1/kbs/article/$post->uuid", $data)
        ->assertStatus(200);
    }
}
