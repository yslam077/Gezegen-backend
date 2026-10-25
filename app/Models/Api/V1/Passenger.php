<?php

namespace App\Models\Api\V1;

use Database\Factories\Api\V1\PassengerFactory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Passenger extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected static function newFactory(): Factory
    {
        return PassengerFactory::new();
    }
}
