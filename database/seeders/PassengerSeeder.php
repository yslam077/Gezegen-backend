<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Api\V1\Passenger;

class PassengerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Passenger::create([
            'full_name' => 'John Doe',
            'phone' => '+99371121278',
        ]);
    }
}
