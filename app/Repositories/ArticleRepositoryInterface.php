<?php
namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

interface ArticleRepositoryInterface
{
    public function create(array $newBookData): Model;

    public function find(int $id): ?Model;

    public function all(): Collection;
}
