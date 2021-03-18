<?php
namespace App\Repositories\Eloquent;

use App\Repositories\RateRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class RateRepository implements RateRepositoryInterface
{
    public function rate(int $articleId, int $stars): Model
    {
        // TODO: Implement rate() method.
    }
}
