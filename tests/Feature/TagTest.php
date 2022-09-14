<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Post;
use App\Models\Tag;
use Tests\TestCase;

class TagTest extends TestCase
{
    public function test_relations()
    {

        $tag = Tag::factory()->create([]);
        $tag->posts()->attach([$post->id]);

        $this->assertInstanceOf(Tag::class, $post->tags()->first());
        $this->assertInstanceOf(Post::class, $tag->posts()->first());
        $this->assertEquals($tag->id,$post->tags()->first()->id);
    }
}
