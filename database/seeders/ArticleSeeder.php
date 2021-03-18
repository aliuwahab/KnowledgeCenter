<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Database\Seeder;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = Category::all();

        if (! $categories) {
            $categories = Category::factory()->count(10)->create();
        }

        Article::factory()->count(1000)->hasAttached($categories)->create();
    }
}
