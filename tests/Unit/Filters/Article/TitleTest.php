<?php

namespace Tests\Unit\Filters\Article;

use App\Models\Article;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TitleTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $this->defaultHeaders = ['Content-Type' => 'application/json', 'Accept' => 'application/json'];
    }

    public function test_can_filter_articles_by_title_search()
    {
        $searchTerm = "Search Term";
        $nonFilteredArticles = Article::factory()->count(3)->create(['created_at' => Carbon::yesterday()]);
        $filteredArticles = Article::factory()->create(['title' => $searchTerm]);

//        $response = $this->get(route('articles.index', ['from' => today()]));
        $response = $this->get('api/articles?title='. $searchTerm);

        $response->assertStatus(200)
            ->assertJsonCount(1, 'data')
            ->assertJsonFragment([$filteredArticles->title])
            ->assertJsonMissing([$nonFilteredArticles->first()->title]);
    }
}
