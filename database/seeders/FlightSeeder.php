<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Api\V1\Flight;
use Carbon\Carbon;

class FlightSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $departure1 = Carbon::now()->addDays(2);
        Flight::create([
            'flight_number' => 'AA101',
            'airline' => 'American Airlines',
            'from_airport_id' => 1,
            'to_airport_id' => 2,
            'departure_time' =>$departure1,
            'arrival_time' =>(clone $departure1)->addHours(3),
            'price' => 180.00,
            'total_seats' => 100,
            'empty_seats' => 1,
        ]);
        Flight::create([
            'flight_number' => 'AA100',
            'airline' => 'American Airlines',
            'from_airport_id' => 1,
            'to_airport_id' => 2,
            'departure_time' => '2026-10-26 08:30:00',
            'arrival_time' => '2026-10-26 11:40:00',
            'price' => 260.00,
            'total_seats' => 100,
            'empty_seats' => 20,
        ]);
    }
}
