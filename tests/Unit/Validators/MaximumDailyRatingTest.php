<?php

namespace Tests\Unit\Validators;

use App\Models\Rate;
use App\Validators\HasNotExceededMaximumDailyRating;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MaximumDailyRatingTest extends TestCase
{

    use RefreshDatabase;

    protected HasNotExceededMaximumDailyRating $hasNotExceededMaximumDailyRating;

    public function setUp(): void
    {
        parent::setUp();

        $this->hasNotExceededMaximumDailyRating = app(HasNotExceededMaximumDailyRating::class);
    }

    public function test_if_maximum_daily_rating_is_exceeded_it_returns_false()
    {
        $userIpAddress = "127.0.0.1";
        Rate::factory()->count(HasNotExceededMaximumDailyRating::MAXIMUM_DAILY_RATINGS)->create(['created_at' => today(), 'ip_address' => $userIpAddress]);

        $this->assertFalse($this->hasNotExceededMaximumDailyRating->passes($userIpAddress));
    }

    public function test_if_it_has_not_exceeded_maximum_daily_rating_it_returns_true()
    {
        $userIpAddress = "127.0.0.1";
        Rate::factory()->count(8)->create(['created_at' => today(), 'ip_address' => $userIpAddress]);

        $this->assertTrue($this->hasNotExceededMaximumDailyRating->passes($userIpAddress));
    }
}
