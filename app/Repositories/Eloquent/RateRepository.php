<?php
namespace App\Repositories\Eloquent;

use App\Models\Rate;
use App\Repositories\RateRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class RateRepository implements RateRepositoryInterface
{
    public function rate(int $articleId, int $stars, string $userIpAddress): Model
    {
        return Rate::updateOrCreate(
            ['ip_address' => $userIpAddress, 'article_id' => $articleId],
            ['rating' => $stars]
        );
    }
}
