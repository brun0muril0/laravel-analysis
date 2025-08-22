<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Data;

class DataFactory extends Factory
{
    
    protected $model = Data::class;

    public function definition(): array
    {
        return [
            'date'  => $this->faker->dateTimeBetween('-15 years', 'now'),
            'value' => $this->faker->randomFloat(2, 10, 500),
        ];
    }
}
