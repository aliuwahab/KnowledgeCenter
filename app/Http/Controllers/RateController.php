<?php

namespace App\Http\Controllers;

use App\Http\Requests\RateArticleRequest;
use App\Http\Resources\RatingResource;
use App\Http\Traits\RespondsWithHttpStatus;
use App\Repositories\RateRepositoryInterface;
use App\Validators\MaximumDailyRating;

class RateController extends Controller
{
    use RespondsWithHttpStatus;

    private RateRepositoryInterface $rateRepository;

    public function __construct(RateRepositoryInterface $rateRepository)
    {
        $this->rateRepository = $rateRepository;
    }

    public function store(RateArticleRequest $rateArticleRequest)
    {
        $dailyRatingCheck = resolve(MaximumDailyRating::class);
        $dailyMaximumExceeded = $dailyRatingCheck->passes($rateArticleRequest->ip());
        if ($dailyMaximumExceeded) {
           return $this->failure($dailyRatingCheck->message());
        }

        $rating = $this->rateRepository->rate($rateArticleRequest->get('articleId'), $rateArticleRequest->get('rate'), $rateArticleRequest->ip());

        return $this->success("Article rated successfully", new RatingResource($rating));
    }
}
