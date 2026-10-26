<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Api\V1\Flight;
use App\Models\Api\V1\Passenger;
use App\Models\Api\V1\Ticket;

class TicketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $flight = Flight::first();
        $passenger = Passenger::first();

        if ($flight && $passenger) {
            Ticket::create([
                'flight_id' => $flight->id,
                'passenger_id' => $passenger->id,
                'passengers_count' => 1,
                'total_price' => $flight->price,
            ]);
            $flight->decrement('empty_seats', 1);
        }
    }
}
