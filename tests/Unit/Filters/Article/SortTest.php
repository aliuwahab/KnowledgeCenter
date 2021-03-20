<?php

namespace Tests\Unit\Filters\Article;


use App\Models\Article;
use App\Models\View;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SortTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $this->defaultHeaders = ['Content-Type' => 'application/json', 'Accept' => 'application/json'];
    }

    public function test_can_sort_articles_by_number_of_views_decending()
    {
        $articleWithLowestViews = Article::factory()->create();
        $articleWithHighestViews = Article::factory()->create();

        View::factory()->count(10)->create(['article_id' => $articleWithHighestViews->id]);
        View::factory()->count(9)->create(['article_id' => $articleWithLowestViews->id]);

//        $response = $this->get(route('articles.index', ['to' => today()]));
        $response = $this->get('api/articles?sort=views');

        $response->assertStatus(200);
        $data = $response->json()['data'];

        $this->assertEquals($articleWithHighestViews->title, $data[0]['title']);
    }

    public function test_can_sort_articles_by_trending_views_decending()
    {
        $articleWithLowestViews = Article::factory()->create();
        $articleWithHighestViews = Article::factory()->create();

        View::factory()->count(10)->create(['article_id' => $articleWithHighestViews->id]);
        View::factory()->count(9)->create(['article_id' => $articleWithLowestViews->id]);

//        $response = $this->get(route('articles.index', ['to' => today()]));
        $response = $this->get('api/articles?sort=trending');

        $response->assertStatus(200);
        $data = $response->json()['data'];

        $this->assertEquals($articleWithHighestViews->title, $data[0]['title']);
    }
}