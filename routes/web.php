<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return \App\Models\Article::query()->addSelect(['total_rating' => static function ($query) {
        $query->selectRaw('SUM(rating)')
            ->from('rates')
            ->whereColumn('article_id', 'articles.id')
            ->limit(1);
    }])->withCount('ratings')->addSelect(['weighted_rating' => static function ($query) {
            $query->selectRaw("(total_rating * ratings_count) / SUM(ratings_count)");
    }])->limit(100)->orderByDesc('weighted_rating')->get();
});
