<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Api\V1\Flight;
use Carbon\Carbon;
use Illuminate\Http\Request;

class FlightController extends Controller
{
    public function index(Request $request){
        $query=Flight::with(['fromAirport','toAirport']);
        if($request->filled('from')){
            $query->where('from_airport_id',$request->from);
        }
        if($request->filled('to')){
            $query->where('to_airport_id',$request->to);
        }
        if($request->filled('date')){
            $query->whereDate('departure_time',$request->date);
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
                'duration'=>"{$diff->h} hr {$diff->i} min",
                'empty_seats'=>$flight->empty_seats,
            ];
        });
        return response()->json($flights);
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'flight_number' => 'required|string|max:50',
            'airline' => 'required|string|max:255',
            'from_airport_id' => 'required|exists:airports,id',
            'to_airport_id' => 'required|exists:airports,id|different:from_airport_id',
            'departure_time' => 'required|date',
            'arrival_time' => 'required|date|after:departure_time',
            'price' => 'required|numeric|min:0',
            'total_seats' => 'required|integer|min:1',
        ]);

        $validated['empty_seats'] = $validated['total_seats'];

        $flight = Flight::create($validated);

        return response()->json([
            'message' => 'Flight created successfully!',
            'flight' => $flight
        ], 201);
    }
    public function update(Request $request, $id)
    {
        $flight = Flight::findOrFail($id);

        $validated = $request->validate([
            'flight_number' => 'sometimes|string|max:50',
            'airline' => 'sometimes|string|max:255',
            'from_airport_id' => 'sometimes|exists:airports,id',
            'to_airport_id' => 'sometimes|exists:airports,id',
            'departure_time' => 'sometimes|date',
            'arrival_time' => 'sometimes|date',
            'price' => 'sometimes|numeric|min:0',
            'empty_seats' => 'sometimes|integer|min:0',
        ]);

        $flight->update($validated);

        return response()->json([
            'message' => 'Flight updated successfully!',
            'flight' => $flight
        ]);
    }
    public function destroy($id)
    {
        $flight = Flight::findOrFail($id);
        $flight->delete();

        return response()->json([
            'message' => 'Flight deleted successfully!'
        ]);
    }
}
