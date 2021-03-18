<?php
namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

interface RateRepositoryInterface
{
    public function rate(int $articleId, int $stars): Model;
}
