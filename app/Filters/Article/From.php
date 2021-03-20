<?php


namespace App\Filters\Article;


use App\Filters\FilterInterface;
use App\Filters\QueryFilter;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;

class From extends QueryFilter implements FilterInterface
{

    public function handle($value): void
    {
        $this->query->whereDate('created_at', '>=', Carbon::parse($value));
    }
}
