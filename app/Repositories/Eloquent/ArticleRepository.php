<?php
namespace App\Repositories\Eloquent;

use App\Models\Article;
use App\Repositories\ArticleRepositoryInterface;
use Illuminate\Support\Collection;

class ArticleRepository implements ArticleRepositoryInterface
{
    private Article $article;

    public function __construct(Article $article)
    {
        $this->article = $article;
    }

    /**
     * @return Collection
     */
    public function all(): Collection
    {
        return $this->article::all();
    }

    /**
     * @param array $validated
     * @return Article
     */
    public function create(array $validated): Article
    {
        $article = new Article();
        $article->title = $validated['title'];
        $article->body = $validated['body'];
        $article->save();

        return $article;
    }

    public function find(int $id): Article
    {
        return $this->article::find($id);
    }
}
