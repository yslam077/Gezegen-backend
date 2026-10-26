<?php

namespace Database\Factories\Api\V1;

use App\Models\Api\V1\Ticket;
use App\Models\Api\V1\Flight;
use App\Models\Api\V1\Passenger;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Ticket>
 */
class TicketFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Ticket::class;
    public function definition(): array
    {
        $flight = Flight::inRandomOrder()->first() ?? Flight::factory();
        $count = $this->faker->numberBetween(1, 3);
        return [
            'flight_id' => $flight->id ?? Flight::factory(),
            'passenger_id' => Passenger::factory(),
            'passengers_count' => $count,
            'total_price' => ($flight->price ?? 100) * $count,
        ];
    }
}
