<?php

namespace Tests\Unit\Filters\Article;

use App\Models\Article;
use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ToTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $this->defaultHeaders = ['Content-Type' => 'application/json', 'Accept' => 'application/json'];
    }

    public function test_can_filter_articles_created_before_a_date()
    {
        $filteredOutArticles = Article::factory()->count(3)->create(['created_at' => today()]);
        $articlesToGet = Article::factory()->count(3)->create(['created_at' => Carbon::yesterday()]);

//        $response = $this->get(route('articles.index', ['to' => today()]));
        $response = $this->get('api/articles?to=' .Carbon::yesterday()->toDateTimeString());

        $response->assertStatus(200)
            ->assertJsonCount(3, 'data')
            ->assertJsonFragment([$articlesToGet->first()->title])
            ->assertJsonMissing([$filteredOutArticles->first()->title]);
    }
}
