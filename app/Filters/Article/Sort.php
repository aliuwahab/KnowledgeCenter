<?php


namespace App\Filters\Article;

use App\Filters\FilterInterface;
use App\Filters\QueryFilter;

class Sort extends QueryFilter implements FilterInterface
{
    public function handle($sortType): void
    {
        if ($sortType === "trending") {
            $this->query->withCount('views')->orderBy('views_count', 'desc');
        }

        if ($sortType === "views") {
            $this->query->withCount('views')->orderBy('views_count', 'desc');
        }
    }
}
