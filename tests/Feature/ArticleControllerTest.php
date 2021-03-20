<?php

namespace Tests\Feature;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ArticleControllerTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $this->defaultHeaders = ['Content-Type' => 'application/json', 'Accept' => 'application/json'];
    }

    public function test_create_article_returns_error_when_validation_fails()
    {
        $invalidData = [];
        $response = $this->post(route('articles.store', $invalidData));

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['title', 'body', 'categories']);
    }


    public function test_can_create_an_article_when_validation_passes()
    {
        $categories = Category::factory()->count(3)->create()->pluck('id');
        $article = Article::factory()->make();
        $articleData = ['title' => $article->title, 'body' => $article->body, 'categories' => $categories->toArray()];

        $response = $this->post(route('articles.store', $articleData));

        $response->assertStatus(200);
    }

    public function test_can_get_a_article()
    {
        $article = Article::factory()->create();

        $response = $this->get(route('articles.show', $article));

        $response->assertStatus(200);
    }

    public function test_can_get_all_articles_wihout_search()
    {
        $numberOfCreatedArticles = 10;
        $categories = Category::factory()->count(2)->create();
        Article::factory()->count($numberOfCreatedArticles)->hasAttached($categories)->create();

        $response = $this->get(route('articles.index'));

        $response->assertStatus(200);
        $response->assertJsonCount($numberOfCreatedArticles, 'data');
    }

    public function test_can_search_articles_based_on_filters()
    {
        $this->markTestSkipped("TODO: searching test");
        $numberOfCreatedArticles = 10;
        $categories = Category::factory()->count(2)->create();
        Article::factory()->count($numberOfCreatedArticles)->hasAttached($categories)->create();

        $response = $this->get(route('articles.index'));

        $response->assertStatus(200);
        $response->assertJsonCount($numberOfCreatedArticles, 'data');
    }
}
