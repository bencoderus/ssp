<?php

namespace Database\Factories;

use App\Models\Campaign;
use Illuminate\Support\Str;
use App\Models\CampaignImage;
use Illuminate\Database\Eloquent\Factories\Factory;

class CampaignImageFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CampaignImage::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $fileName = Str::random(26);

        return [
            'title' => "{$fileName}.jpg",
            'campaign_id' => Campaign::factory()->create()->id,
        ];
    }
}
