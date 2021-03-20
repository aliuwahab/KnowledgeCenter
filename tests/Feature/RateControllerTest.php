<?php

namespace Tests\Feature;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RateControllerTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $this->defaultHeaders = ['Content-Type' => 'application/json', 'Accept' => 'application/json'];
    }

    public function test_it_returns_error_if_validation_failes()
    {
        $invalidData = [];

        $response = $this->post(route('rates.store', $invalidData));

        $response->assertStatus(422)->assertJsonValidationErrors(['rate', 'articleId']);
    }

    public function test_it_rates_an_article_if_validation_passes()
    {
        $categories = Category::factory()->count(2)->create();
        $article = Article::factory()->hasAttached($categories)->create();
        $validData = ['rate' => 3, 'articleId' => $article->id];

        $response = $this->post(route('rates.store', $validData));

        $response->assertStatus(200);
    }
}
