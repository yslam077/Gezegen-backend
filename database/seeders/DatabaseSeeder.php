<?php

namespace Database\Seeders;

use App\Models\Hotel\Hotel;
use App\Models\Hotel\Room;
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
        User::firstOrCreate(
            ['email' => 'test@example.com'],
            [
                'name' => 'Test User',
                'password' => bcrypt('password'),
            ]
        );
        $this->call([
            AirportSeeder::class,
            PassengerSeeder::class,
            FlightSeeder::class,
            TicketSeeder::class,
        ]);
        Airport::factory()->count(100)->create();
        Flight::factory()->count(100)->create();
        Ticket::factory()->count(100)->create();
    }
}
