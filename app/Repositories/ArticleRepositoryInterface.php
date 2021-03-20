<?php
namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\Paginator;

interface ArticleRepositoryInterface
{
    public function create(string $title, string $body, array $categories): Model;

    public function find(int $id): ?Model;

    public function all(array $filter = [], int $paginateBy = 50): Paginator;
}
