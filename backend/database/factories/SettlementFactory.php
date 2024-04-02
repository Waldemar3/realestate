<?php

namespace Database\Factories;

use App\Models\Settlement;
use Illuminate\Database\Eloquent\Factories\Factory;

class SettlementFactory extends Factory
{
    protected $model = Settlement::class;

    public function definition()
    {
        return [
            'name' => $this->faker->city,
            'address' => $this->faker->address,
            'area' => $this->faker->randomFloat(2, 1, 100),
            'hotline' => $this->faker->phoneNumber,
            'youtube_video' => $this->faker->url,
        ];
    }
}
