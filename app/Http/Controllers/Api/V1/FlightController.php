<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Api\V1\Flight;
use Carbon\Carbon;
use Illuminate\Http\Request;

class FlightController extends Controller
{
    public function index(Request $request){
        $query=Flight::with(['from_Airport','toAirport']);
        if($request->filled('from')){
            $query->where('from_airport_id',$request->from);
        }
        if($request->filled('to')){
            $query->where('to_airport_id',$request->from);
        }
        if($request->filled('date')){
            $query->whereDate('departume_time',$request->date);
        }
        $flights=$query->get()->map(function ($flight) {
            $dep=Carbon::parse($flight->departure_time);
            $arr=Carbon::parse($flight->arrival_time);
            $diff=$dep->diff($arr);
            return[
                'id'=>$flight->id,
                'flight_number'=>$flight->flight_number,
                'airline'=>$flight->airline,
                'from_airport'=>$flight->fromAirport,
                'to_airport'=>$flight->toAirport,
                'departure_time'=>$dep->format('H:i'),
                'arrival_time'=>$arr->format('H:i'),
                'duration'=>'{$diff->h}hr{$diff->i}min',
                'empty_seats'=>$flight->empty_seats,
            ];
        });
        return response()->json();
    }
}
