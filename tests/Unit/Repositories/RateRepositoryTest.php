<?php

namespace Tests\Unit\Repositories;


use App\Models\Article;
use App\Models\Category;
use App\Repositories\RateRepositoryInterface;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RateRepositoryTest extends TestCase
{
    use RefreshDatabase;

    protected RateRepositoryInterface $rateRepository;

    public function setUp(): void
    {
        parent::setUp();

        $this->rateRepository = resolve(RateRepositoryInterface::class);
    }

    public function test_can_rate_an_article()
    {
        $article = Article::factory()->hasAttached(Category::factory()->count(3))->create();
        $articleId = $article->id;
        $stars = 4;
        $ipAddress = 4;

        $this->rateRepository->rate($articleId, $stars, $ipAddress);

        $this->assertDatabaseHas('rates', ['id' => $articleId, 'rating' => $stars, 'ip_address' => $ipAddress]);
    }
}
