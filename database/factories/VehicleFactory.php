<?php

namespace Database\Factories;

use App\Base\Vehicle\Location;
use App\Models\Enums\VehicleAvailabilityStatus;
use App\Models\Model;
use Illuminate\Database\Eloquent\Factories\Factory;
use PhpParser\Builder\EnumCase;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class VehicleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'model_id' => Model::factory(),
            'vin' => strtoupper($this->faker->unique()->bothify('??##############')),
            'number_plate' => strtoupper($this->faker->bothify('???-###')),
            'status' => VehicleAvailabilityStatus::random(),
            'location' => Location::from([
                'latitude' => $this->faker->latitude(),
                'longitude' => $this->faker->longitude(),
            ]),
        ];
    }
}
