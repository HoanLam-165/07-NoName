<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    public function definition()
    {
        return [
            'CustomerID' => $this->faker->numberBetween(1, 100),
            'CategoryID' => $this->faker->numberBetween(1, 3),
            'FromLocation' => $this->faker->address(),
            'ToLocation' => $this->faker->address(),
            'Total' => $this->faker->randomFloat(2, 50, 500),
            'Charge' => $this->faker->randomFloat(2, 10, 50),
        ];
    }
}