<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\RentPointUser>
 */
class RentPointUserFactory extends Factory {
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array {
        return [
            'rent_point_id' => \App\Models\RentPoint::factory(),
            'user_id' => \App\Models\User::factory(),
        ];
    }
}
