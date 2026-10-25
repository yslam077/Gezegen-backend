<?php

namespace App\Models\Api\V1;

use Database\Factories\Api\V1\AirportFactory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Airport extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected static function newFactory(): Factory
    {
        return AirportFactory::new();
    }
}
