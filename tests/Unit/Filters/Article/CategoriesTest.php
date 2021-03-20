<?php

namespace Tests\Unit\Filters\Article;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CategoriesTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $this->defaultHeaders = ['Content-Type' => 'application/json', 'Accept' => 'application/json'];
    }

    public function test_can_filter_articles_by_categories()
    {
        $nonFilterCategory = Category::factory()->count(2)->create();
        $filteredCategory = Category::factory()->count(2)->create();
        $nonFilteredArticles = Article::factory()->count(3)->hasAttached($nonFilterCategory)->create();
        $filteredArticles = Article::factory()->count(3)->hasAttached($filteredCategory)->create();

        $response = $this->get(route('articles.index', ['categories' => implode(',', $filteredCategory->pluck('id')->toArray())]));

        $response->assertStatus(200)
            ->assertJsonCount(3, 'data')
            ->assertJsonFragment([$filteredArticles->first()->title])
            ->assertJsonMissing([$nonFilteredArticles->first()->title]);
    }
}
