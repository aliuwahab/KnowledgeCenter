<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\RateController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::resource('articles', ArticleController::class)->only(['index', 'show', 'store', 'update', 'destroy']);
Route::resource('rates', RateController::class)->only(['store']);