<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\View;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
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
        ini_set('memory_limit', '512M');
        DB::disableQueryLog();

        $articles = Article::limit(50)->get()->pluck('id');

        if (! $articles) {
            $articles = Article::factory()->count(50)->create()->pluck('id');
        }

        $total = 100000;
        $set = 2000;

        for ($created = $set; $created <= $total; $created+= $set) {
            $views = View::factory()->count($set)->make(['article_id' => Arr::random($articles->toArray())]);
            DB::table('views')->insert($views->toArray());
        }
    }
}
