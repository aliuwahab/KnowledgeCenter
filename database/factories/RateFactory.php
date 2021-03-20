<?php

namespace Database\Factories;

use App\Models\Article;
use App\Models\Rate;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

class RateFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Rate::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'ip_address' => $this->faker->ipv6,
            'article_id' => Article::factory()->create()->id,
            'rating' => 1,
        ];
    }
}
