<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Api\V1\Airport;
use Illuminate\Http\Request;

class AirportController extends Controller
{
    public function index(){
        return response()->json(Airport::all());
    }
}
