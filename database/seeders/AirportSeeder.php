<?php

namespace Database\Seeders;

use App\Models\Api\V1\Airport;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AirportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Airport::create([
            'name'=>'John F.Keenedy International',
            'code'=>'TFK',
            'city'=>'New York',
        ]);
        Airport::create([
            'name'=>'Turkemn Howayyolary',
            'code'=>'THY',
            'city'=>'Ashgabat',
        ]);
        Airport::create([
            'name' => 'Los Angeles International',
            'code' => 'LAX',
            'city' => 'Los Angeles',
        ]);
    }
}
