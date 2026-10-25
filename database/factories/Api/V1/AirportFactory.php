<?php

namespace Database\Factories\Api\V1;

use App\Models\Api\V1\Airport;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Airport>
 */
class AirportFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->city() . ' International Airport',
            'code' => strtoupper($this->faker->lexify('???')),
            'city' => $this->faker->city(),
        ];
    }
}
