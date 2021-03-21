<?php
namespace App\Repositories\Eloquent;

use App\Models\Article;
use App\Repositories\ArticleRepositoryInterface;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Cache;

class ArticleRepository implements ArticleRepositoryInterface
{
    private Article $article;

    public function __construct(Article $article)
    {
        $this->article = $article;
    }

    public function all(array $filter = [], int $paginateBy = 50): Paginator
    {
        return $this->article::query()->with(['categories', 'views', 'ratings'])->filterBy($filter)->simplePaginate($paginateBy);
    }

    public function create(string $title, string $body, array $categories): Article
    {
        $article = new Article();
        $article->title = $title;
        $article->body = $body;
        $article->save();

        $article->categories()->sync($categories);

        return $article;
    }

    public function find(int $id): Article
    {
        return $this->article::find($id);
    }
}
