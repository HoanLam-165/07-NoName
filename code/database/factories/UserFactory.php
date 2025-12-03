<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition()
    {
        return [
            'UserName' => $this->faker->userName(),
            'Mobile' => $this->faker->phoneNumber(),
            'RoleID' => 2, // default customer role (nếu có)
        ];
    }
}
