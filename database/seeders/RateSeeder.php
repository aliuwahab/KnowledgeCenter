<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Rate;
use App\Models\View;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RateSeeder extends Seeder
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

        $rates = Rate::factory()->count(50)->make(['article_id' => 1]);
        DB::table('rates')->insert($rates->toArray());
    }
}
