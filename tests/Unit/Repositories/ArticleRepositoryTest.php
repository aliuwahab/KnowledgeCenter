<?php

namespace Tests\Unit\Repositories;

use App\Models\Article;
use App\Models\Category;
use App\Repositories\ArticleRepositoryInterface;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ArticleRepositoryTest extends TestCase
{
    use RefreshDatabase;

    protected ArticleRepositoryInterface $articleRepository;

    public function setUp(): void
    {
        parent::setUp();

        $this->articleRepository = app(ArticleRepositoryInterface::class);
    }

    public function test_can_create_an_article()
    {
        $categories = Category::factory()->count(3)->create()->pluck('id')->toArray();
        $articleData = Article::factory()->make();
        $article = $this->articleRepository->create($articleData->title, $articleData->body, $categories);

        $this->assertDatabaseHas('articles', ['id' => $article->id, 'title' => $article->title, 'body' => $article->body]);
    }

    public function test_can_get_an_article()
    {
        $articles = Article::factory()->hasAttached(Category::factory()->count(3))->count(5)->create();
        $article = $articles->first();

        $foundArticle = $this->articleRepository->find($article->id);

        $this->assertEquals($article->title, $foundArticle->title);
    }

    public function test_can_get_all_articles()
    {
        $articles = Article::factory()->hasAttached(Category::factory()->count(3))->count(5)->create();
        $foundArticles = $this->articleRepository->all();

        $this->assertEquals($articles->count(), $foundArticles->count());
    }

}
