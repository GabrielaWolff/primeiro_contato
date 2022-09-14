<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tag;
use App\Models\User;
use App\Models\Post;


class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tag = Tag::factory()->create();

        $post = Post::factory()->create([
            'user_id'=> User::first()->id
        ]);
        $post->tags()->attach([$tag->id]);
        
    }
}
