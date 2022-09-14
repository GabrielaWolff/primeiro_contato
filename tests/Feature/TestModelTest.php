<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Post;
use App\Models\Tag;
use Tests\TestCase;

class TestModelTest extends TestCase
{

    public function test_relations()
    {
        $user = User::factory()->create([]);
        $post = Post::factory()->create([
            'user_id' => $user->id
        ]);
        $tag = Tag::factory()->create([]);
        $tag->posts()->attach([$post->id]);

        $this->assertInstanceOf(Tag::class, $post->tags()->first());
        $this->assertInstanceOf(Post::class, $tag->posts()->first());
        $this->assertEquals($tag->id,$post->tags()->first()->id);
    }

    public function test_count()
    {

        $user = User::factory()->create();
        $post = Post::factory()->create([
            'user_id' => $user->id
        ]);

        $tag1 = Tag::factory()->create([]);
        $tag2 = Tag::factory()->create([]);

        $post->tags()->attach([$tag1->id,$tag2->id]);

        $this->assertEquals(2, $post->tags()->count());
    }
}