<?php

namespace Database\Factories;

use App\Models\Enums\RentalHistoryStatus;
use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\RentalHistory>
 */
class RentalHistoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     * @throws \Random\RandomException
     */
    public function definition() : array
    {
        $start = $this->faker->dateTimeBetween('-1 month', 'now');

        return [
            'renter_id' => User::factory(),
            'vehicle_id' => Vehicle::factory(),
            'started_at' => $start,
            'ended_at' => (clone $start)->modify('+'.random_int(10, 60).' minutes'),
            'status' => RentalHistoryStatus::random(),
        ];
    }
}
