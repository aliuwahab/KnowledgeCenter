<?php


namespace App\Filters\Article;


use App\Filters\FilterInterface;
use App\Filters\QueryFilter;

class Categories extends QueryFilter implements FilterInterface
{
    public function handle($categoriesIds): void
    {
        $categoriesIds = explode(",", $categoriesIds);
        $this->query->whereHas('categories', function ($q) use ($categoriesIds) {
            return $q->whereIn('categories.id', $categoriesIds);
        });
    }
}
