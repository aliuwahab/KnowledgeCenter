<?php


namespace App\Filters\Article;

use App\Filters\FilterInterface;
use App\Filters\QueryFilter;
use Carbon\Carbon;
use Illuminate\Support\Str;

class Sort extends QueryFilter implements FilterInterface
{
    public function handle($sortType): void
    {
        if (Str::contains($sortType, 'trending')) {
            list($startDate, $endDate) = $this->getTrendDates($sortType);

            $this->query->withCount(['views' => static function($query) use ($startDate, $endDate) {
                $query->whereBetween('created_at', [$startDate, $endDate]);
            }])->orderByDesc('views_count');
        }

        if (Str::contains($sortType, 'popularity')) {
            $this->query->addSelect(['total_rating' => static function ($query) {
                $query->selectRaw('SUM(rating)')
                    ->from('rates')
                    ->whereColumn('article_id', 'articles.id')
                    ->limit(1);
            }])->withCount('ratings')->addSelect(['weighted_rating' => static function ($query) {
                $query->selectRaw("(total_rating * ratings_count) / SUM(ratings_count)");
            }])->orderByDesc('weighted_rating');
        }
    }


    private function getTrendDates(string $sortType): array
    {
        $startDate = null;
        $endDate = null;

        $queryParams = explode(':', $sortType);

        $findStart = collect($queryParams)->filter(static function ($value, $key) {
            return Str::contains($value, 'start');
        });

        $findEndDate = collect($queryParams)->filter(static function ($value, $key) {
            return Str::contains($value, 'to');
        });

        $startDateArray = explode('=', $findStart->first());
        $endDateArray = explode('=', $findEndDate->first());

        if (isset($startDateArray[1]) && Carbon::createFromFormat('Y-m-d', $startDateArray[1]) !== false) {
            $startDate = Carbon::parse($startDateArray[1]);
        }

        if (isset($endDateArray[1]) && Carbon::createFromFormat('Y-m-d', $endDateArray[1]) !== false) {
            $endDate = Carbon::parse($endDateArray[1]);
        }

        if ($startDate == null) {
            $startDate = Carbon::create(2021, 01, 14); // Set it on a date before the app started operating
        }

        if ($endDate == null) {
            $endDate = Carbon::now();
        }

        return array($startDate, $endDate);
    }
}
