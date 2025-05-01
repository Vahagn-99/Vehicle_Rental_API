<?php

namespace Database\Factories;

use App\Models\Brand;
use App\Models\Enums\ModelBodyType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ModelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->word(),
            'brand_id' => Brand::factory(),
            'year' => $this->faker->year(),
            'engine' => $this->faker->randomElement(['1.5L', '2.0L', 'Electric']),
            'body_type' => ModelBodyType::random(),
        ];
    }
}
