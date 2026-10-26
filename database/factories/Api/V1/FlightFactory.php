<?php

namespace Database\Factories\Api\V1;

use App\Models\Api\V1\Airport;
use App\Models\Api\V1\Flight;
use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;

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
        $departure = now()->addDays($this->faker->numberBetween(1, 90));
        $totalSeats = $this->faker->randomElement([50, 100, 150, 200]);
        $emptySeats = $this->faker->numberBetween(10, $totalSeats);
        return [
            'flight_number'=>'AA'.$this->faker->numberBetween(100,999),
            'airline'=>'American Airlines',
            'from_airport_id'=>Airport::inRandomOrder()->first()?->id??1,
            'to_airport_id'=>Airport::inRandomOrder()->first()?->id??2,
            'departure_time'=>$departure,
            'arrival_time'=>(clone $departure)->addHours(3),
            'price'=>$this->faker->randomFloat(2, 100, 500),
            'total_seats'=>$totalSeats,
            'empty_seats'=>$emptySeats,
        ];
    }
}
