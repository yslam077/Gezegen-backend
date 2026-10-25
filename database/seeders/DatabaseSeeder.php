<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Api\V1\Airport;
use App\Models\Api\V1\Flight;
use App\Models\Api\V1\Passenger;
use App\Models\Api\V1\Ticket;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
        $this->call([
            AirportSeeder::class,
            PassengerSeeder::class,
            FlightSeeder::class,
            TicketSeeder::class,
        ]);
        Airport::factory()->count(100)->create();
        Flight::factory()->count(100)->create();
        Passenger::factory()->count(10)->create()->each(function ($passenger) {
            Ticket::factory()->create([
                'passenger_id' => $passenger->id,
            ]);
        });
    }
}
