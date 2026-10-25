<?php

namespace Database\Factories;

use App\Models\Api\V1\Airport;
use App\Models\Flight;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Flight>
 */
class FlightFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'flight_number'=>'AA'.$this->fake()->numberBetween(100,999),
            'airline'=>'American Airlines',
            'from_airport_id'=>Airport::inRandomOrder()->first()?->id??1,
            'to_airport_id'=>Airport::inRandomOrder()->first()?->id??2,
            'departure_time'=>now()->addDays(1),
            'arrival_time'=>now()->addDays(1)->addHours(3),
            'price'=>$this->fake()->randomFloat(2,100,500),
            'total_seats'=>100,
            'empty_seats'=>100,
        ];
    }
}
