<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Api\V1\Passenger;
use Illuminate\Http\Request;

class PassengerController extends Controller
{
    public function index(){
        $passengers=Passenger::with('tickets')->get();
        return response()->json([
            'success'=>true,
            'data'=>$passengers,
        ]);
    }
    public function show($id)
    {
        $passenger = Passenger::with('tickets')->find($id);
        if (!$passenger) {
            return response()->json([
                'success' => false,
                'message' => 'Пассажир не найден'
            ], 404);
        }
        return response()->json([
            'success' => true,
            'data' => $passenger
        ]);
    }
    public function store(Request $request){
        $validated=$request->validate([
            'full_name'=>'required|string|max:255',
            'phone'=>'nullable|string|max:50',
        ]);
        $passenger=Passenger::create($validated);
        return response()->json([
            'success'=>true,
            'messanger'=>'ustinlikli gosuldy',
            'data'=>$passenger,
        ],201);
    }
    public function update(Request $request,$id){
        $passengers=Passenger::find($id);
        if (!$passengers) {
            return response()->json([
                'success' => false,
                'message' => 'Пассажир не найден'
            ], 404);
        }
        $validate=$request->validate([
            'full_name'=>'sometimes|required|string|max:255',
            'phone'=>'nullable|string|max:50',
        ]);
        $passengers->update($validate);
        return response()->json([
            'success' => true,
            'message' => 'Passenger successfully updated',
            'data' => $passengers,
        ]);
    }
    public function destroy($id){
        $passengers=Passenger::find($id);
        if (!$passengers) {
            return response()->json([
                'success' => false,
                'message' => 'Пассажир не найден'
            ], 404);
        }
        $passengers->delete();
        return response()->json([
            'success' => true,
            'message' => 'Passenger successfully deleted'
        ], 200);
    }
}
