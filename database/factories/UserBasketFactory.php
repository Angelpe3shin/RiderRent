<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UserBasket>
 */
class UserBasketFactory extends Factory {
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array {
        $moto = \App\Models\Moto::factory();
        $startDate = $this->faker->dateTimeThisMonth();
        $endDate = $this->faker->dateTimeThisMonth($startDate); // Пример: добавляем случайное количество дней

        $rentalDays = $startDate->diffInDays($endDate); // Вычисляем длительность аренды в днях
        $totalRentalPrice = $moto->base_rental_price_per_day * $rentalDays;
        return [
            'user_id' => \App\Models\User::factory(),
            'moto_id' => $moto->id,
            'quantity' => $this->faker->randomNumber(2),
            'status' => $this->faker->randomElement(['pendingTransaction', 'paymentFinished', 'removedWithoutFinish']),
            'start_date' => $startDate,
            'end_date' => $endDate,
            'total_price' => $totalRentalPrice,
            'total_price_currency' => 'EUR',
        ];
    }
}
