<?php

namespace Database\Factories;

use App\Models\Enums\RentStatus;
use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Rent>
 */
class RentFactory extends Factory
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
            'vehicle_id' => Vehicle::factory(),
            'status' => RentStatus::random(),
        ];
    }
}
