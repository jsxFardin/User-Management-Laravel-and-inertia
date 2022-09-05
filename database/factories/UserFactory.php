<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'id_no' => $this->faker->numerify('###-###-####'),
            'name' => $this->faker->name,
            'username' => $this->faker->userName(),
            'email' => $this->faker->unique()->safeEmail,
            'mobile' => $this->faker->unique()->phoneNumber,
            'password'  => 12345678,
            'email_verified_at' => now(),
            'remember_token' => null,
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return static
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
