<?php

namespace Tests\Unit\Filters\Article;

use App\Models\Article;
use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FromTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $this->defaultHeaders = ['Content-Type' => 'application/json', 'Accept' => 'application/json'];
    }

    public function test_can_filter_articles_created_from_a_date()
    {
        $nonFilteredArticles = Article::factory()->count(3)->create(['created_at' => Carbon::yesterday()]);
        $filteredArticles = Article::factory()->count(3)->create(['created_at' => today()]);

//        $response = $this->get(route('articles.index', ['from' => today()]));
        $response = $this->get('api/articles?from='.today()->toDateTimeString());

        $response->assertStatus(200)
            ->assertJsonCount(3, 'data')
            ->assertJsonFragment([$filteredArticles->first()->title])
            ->assertJsonMissing([$nonFilteredArticles->first()->title]);
    }
}
