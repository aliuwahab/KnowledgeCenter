<?php


namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;

abstract class QueryFilter
{
    protected $query;

    public function __construct(Builder $query)
    {
        $this->query = $query;
    }
}
