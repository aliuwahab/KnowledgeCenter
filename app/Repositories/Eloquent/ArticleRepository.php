<?php
namespace App\Repositories\Eloquent;

use App\Models\Article;
use App\Repositories\ArticleRepositoryInterface;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Cache;

class ArticleRepository implements ArticleRepositoryInterface
{
    private Article $article;

    public function __construct(Article $article)
    {
        $this->article = $article;
    }

    public function all(array $filters = [], int $paginateBy = 50): Paginator
    {
        $cacheKey = implode("-", array_keys($filters)) .'-'. implode('-', array_values($filters));
        return Cache::rememberForever($cacheKey, function () use($filters, $paginateBy){
            return $this->article::query()->with(['categories', 'views', 'ratings'])->filterBy($filters)->simplePaginate($paginateBy);
        });
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
