<?php

namespace Database\Factories;

use App\Models\House;
use App\Models\Settlement;
use Illuminate\Database\Eloquent\Factories\Factory;

class HouseFactory extends Factory
{
    protected $model = House::class;
    
    public function definition()
    {
        return [
            'name' => $this->faker->streetName,
            'price_usd' => $this->faker->numberBetween(1000, 10000),
            'floors' => $this->faker->numberBetween(1, 3),
            'bedrooms' => $this->faker->numberBetween(1, 5),
            'area' => $this->faker->randomFloat(2, 50, 200),
            'type' => $this->faker->randomElement(['Дом', 'Коттедж', 'Таунхаус', 'Квартира']),
            'settlement_id' => $this->faker->randomElement(Settlement::pluck('id')),
        ];
    }
}
