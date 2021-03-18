<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Category;
use App\Models\View;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ViewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $articles = Article::all();

        if (! $articles) {
            $articles = Article::factory()->count(1000)->create();
        }

        $views = View::factory()->count(500)->make(['article_id' => $articles->random()->id]);
        DB::table('views')->insert($views->toArray());
    }
}
