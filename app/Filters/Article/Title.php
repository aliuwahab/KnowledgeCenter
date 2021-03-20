<?php


namespace App\Filters\Article;


use App\Filters\FilterInterface;
use App\Filters\QueryFilter;

class Title extends QueryFilter implements FilterInterface
{

    public function handle($value): void
    {
        $fuzzySearch = "%$value%";
        $this->query->where('title', "like", $fuzzySearch);
    }
}
