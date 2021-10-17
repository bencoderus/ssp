<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Campaign;
use Illuminate\Database\Eloquent\Factories\Factory;

class CampaignFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Campaign::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'code' => $this->faker->md5,
            'daily_budget' => random_int(100, 100000),
            'total_budget' => random_int(100000, 1000000),
            'start_date' => now(),
            'end_date' => now()->addDays(random_int(1, 30)),
            'user_id' => User::factory()->create()->id,
        ];
    }
}
