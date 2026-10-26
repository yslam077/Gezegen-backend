<?php

namespace Database\Factories\Api\V1;

use App\Models\Api\V1\Passenger;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Passenger>
 */
class PassengerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Passenger::class;
    public function definition(): array
    {
        return [
            'full_name' => $this->faker->name(),
            'phone' => '+993' . $this->faker->numerify('########'),
        ];
    }
}
