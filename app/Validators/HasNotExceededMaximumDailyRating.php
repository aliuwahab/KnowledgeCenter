<?php

namespace App\Validators;

use App\Models\Rate;

class HasNotExceededMaximumDailyRating
{
    public const MAXIMUM_DAILY_RATINGS = 10;

    /**
     * Determine if the validation rule passes.
     *
     * @param string $ipAddress
     * @return bool
     */
    public function passes(string $ipAddress)
    {
        return $this->maximumDailyRatingExceeded($ipAddress);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'You have exceeded the maximum daily ratings of ' . self::MAXIMUM_DAILY_RATINGS;
    }

    private function maximumDailyRatingExceeded(string $userIpAddress): bool
    {
        $todayRating = Rate::where('created_at', today())->where('ip_address', $userIpAddress)->count();

        return self::MAXIMUM_DAILY_RATINGS > $todayRating;
    }
}
