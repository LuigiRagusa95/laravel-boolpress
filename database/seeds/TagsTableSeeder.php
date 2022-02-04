<?php

use App\Tag;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tags = ['Front-End', 'Back-End', 'Laravel', 'UX', 'Design'];

        foreach ($tags as $tag) {
            $t = new Tag();
            $t->name = $tag;
            $t->slug = Str::slug($t->name, '-');

            $t->save();
        }
    }
}
