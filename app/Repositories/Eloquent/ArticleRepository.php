<?php
namespace App\Repositories\Eloquent;

use App\Models\Article;
use App\Repositories\ArticleRepositoryInterface;
use Illuminate\Pagination\Paginator;

class ArticleRepository implements ArticleRepositoryInterface
{
    private Article $article;

    /**
     * ArticleRepository constructor.
     * @param Article $article
     */
    public function __construct(Article $article)
    {
        $this->article = $article;
    }

    /**
     * @param array $filter
     * @param int $paginateBy
     * @return Paginator
     */
    public function all(array $filter = [], int $paginateBy = 50): Paginator
    {
        return $this->article::with(['categories', 'views', 'ratings'])->filterBy($filter)->simplePaginate($paginateBy);
    }

    /**
     * @param string $title
     * @param string $body
     * @param array $categories
     * @return Article
     */
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
