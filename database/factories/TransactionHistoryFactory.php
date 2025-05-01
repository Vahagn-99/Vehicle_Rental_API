<?php

namespace Database\Factories;

use App\Models\Enums\TransactionHistoryType;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TransactionHistory>
 */
class TransactionHistoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition() : array
    {
        return [
            'renter_id' => User::factory(),
            'amount' => $this->faker->randomFloat(2, 10, 100),
            'type' => TransactionHistoryType::random(),
        ];
    }
}
