<?php


namespace App\Filters\Article;


use App\Filters\FilterInterface;
use Illuminate\Database\Eloquent\Builder;

class Body implements FilterInterface
{
    protected $query;

    public function __construct(Builder $query)
    {
        $this->query = $query;
    }

    public function handle($value): void
    {
        $fuzzySearch = "%$value%";
        $this->query->where('body', "like", $fuzzySearch);
    }
}
