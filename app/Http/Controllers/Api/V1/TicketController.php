<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Api\V1\Flight;
use App\Models\Api\V1\Passenger;
use App\Models\Api\V1\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class TicketController extends Controller
{
    public function store(Request $request){
        $validated=$request->validate([
            'flight_id'=>'required|exists:flight,id',
            'full_name'=>'required|string|max:255',
            'phone'=>'nullable|string|max:50',
            'passengers_count'=>"required|integer|min:1",
        ]);
        $flight=Flight::findOrFail($validated['flight_id']);
        if($flight->empty_seats<$validated['passengers_count']){
            return response()->json();
        }
        return DB::transaction(function()use($validated,$flight){
            $passenger=Passenger::firstOrCreate(
            ['full_name'=>$validated['full_name'],'phone'=>$validated['phone']??null]
            );
            $ticket=Ticket::create([
                'flight_id'=>$flight->id,
                'passenger_id'=>$passenger->id,
                'passengers_count'=>$validated['passengers_count'],
                'total_price'=>$flight->price*$validated['passengers_count'],
            ]);
            $flight->decrement('empty_seats',$validated['passengers_count']);
            return response()->json([
                'message'=>'Ticket succesfuly',
                'ticket'->$ticket,
                'remaining_seats'=>$flight->fresh()->empty_seats,
            ],201);
        });
    }
}
