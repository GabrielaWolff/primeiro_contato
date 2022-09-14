<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tag;
use App\Models\User;
use App\Models\Post;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::factory()->create([]);

        $post = Post::factory()->create([
            'user_id'=> $user->id
        ]);

        $tag = Tag::factory()->create([]);

        $tag->posts()->attach([$post->id]);
    }

}
