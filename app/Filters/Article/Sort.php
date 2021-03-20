<?php


namespace App\Filters\Article;

use App\Filters\FilterInterface;
use App\Filters\QueryFilter;

class Sort extends QueryFilter implements FilterInterface
{
    public function handle($sortType): void
    {
        if ($sortType === "trending") {
            $this->query->withCount('views')->orderByDesc('views_count');
        }

        if ($sortType === "popularity") {
            $this->query->addSelect(['total_rating' => static function ($query) {
                $query->selectRaw('SUM(rating)')
                    ->from('rates')
                    ->whereColumn('article_id', 'articles.id')
                    ->limit(1);
            }])->withCount('ratings')->addSelect(['weighted_rating' => static function ($query) {
                $query->selectRaw("(total_rating * ratings_count) / SUM(ratings_count)");
            }])->orderByDesc('weighted_rating');
        }
    }
}
