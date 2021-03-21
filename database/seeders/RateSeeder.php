<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Rate;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
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
        ini_set('memory_limit', '512M');
        DB::disableQueryLog();

        $articles = Article::limit(10)->get()->pluck('id');

        if (! $articles) {
            $articles = Article::factory()->count(10)->create()->pluck('id');
        }

        $total = 10000;
        $set = 2500;

        for ($created = $set; $created <= $total; $created+= $set) {
            $rates = Rate::factory()->count($set)->make(['article_id' => Arr::random($articles->toArray())]);
            DB::table('rates')->insert($rates->toArray());
        }

    }
}
