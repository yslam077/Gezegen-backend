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
    
    public function index(Request $request)
    {
        $query = Ticket::with(['flight.fromAirport', 'flight.toAirport', 'passenger']);
        if($request->has('full_name')&& !empty($request->full_name)){
            $searchName=$request->full_name;
            $query->whereHas('passenger',function($q)use ($searchName){
                $q->where('full_name', 'ILIKE', "%{$searchName}%");
            });
        }

        if($request->has('phone')&& !empty($request->phone)){
            $searchPhone=$request->phone;
            $query->whereHas('passenger',function($q)use ($searchPhone){
                $q->where('phone', 'ILIKE', "%{$searchPhone}%");
            });
        }
        $tickets=$query->get();

        return response()->json([
            'success' => true,
            'data' => $tickets
        ]);
    }

    public function show($id)
    {
        $ticket = Ticket::with(['flight', 'passenger'])->find($id);
        if (!$ticket) {
            return response()->json([
                'success' => false,
                'message' => 'Билет не найден'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $ticket
        ]);
    }

   
    public function store(Request $request)
    {
        $validated = $request->validate([
            'flight_id' => 'required|exists:flights,id',
            'passengers_count' => 'required|integer|min:1',
            'passengers' => 'required|array|min:1',
            'passengers.*.full_name' => 'required|string|max:255',
            'passengers.*.phone' => 'nullable|string|max:50',
        ]);

        $flight = Flight::find($validated['flight_id']);
        if (!$flight) {
            return response()->json([
                'message' => 'gozlenen yer tapylmady'
            ], 404);
        }
        if ($flight->empty_seats < $validated['passengers_count']) {
            return response()->json([
                'message' => 'Bos yer yok'
            ], 422);
        }

        return DB::transaction(function () use ($validated, $flight) {
            $createdTickets = [];

            foreach ($validated['passengers'] as $passengerData) {
                $passenger = Passenger::firstOrCreate(
                    [
                        'full_name' => $passengerData['full_name'],
                        'phone' => $passengerData['phone'] ?? null
                    ]
                );

                $ticket = Ticket::create([
                    'flight_id' => $flight->id,
                    'passenger_id' => $passenger->id,
                    'passengers_count' => 1,
                    'total_price' => $flight->price,
                ]);

                $ticket->load(['passenger', 'flight']);
                $createdTickets[] = $ticket;
            }

            
            $flight->decrement('empty_seats', $validated['passengers_count']);

            return response()->json([
                'message' => 'Билеты успешно забронированы!',
                'tickets' => $createdTickets,
                'remaining_seats' => $flight->fresh()->empty_seats,
            ], 201);
        });
    }
}