<?php

use App\Post;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 5; $i++) {
            $post = new Post();
            $post->title = 'Post title' . ($i + 1);
            $post->slug = Str::slug($post->title, '-');
            $post->text = "Lorem ipsum dolor, sit amet consectetur adipisicing elit. Eveniet ipsum sunt excepturi iure error, distinctio ullam tempore illo natus iusto fuga atque totam quia sapiente aliquam, magni magnam veritatis laborum?";

            $post->save();
        }
    }
}
