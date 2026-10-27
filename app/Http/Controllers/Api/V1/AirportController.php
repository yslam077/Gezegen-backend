<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Api\V1\Airport;
use Illuminate\Http\Request;

class AirportController extends Controller
{
    public function index()
    {
        return response()->json(Airport::all());
    }
    public function show($id)
    {
        $airport = Airport::find($id);

        if(!$airport){
            return response()->json([
                'success' => false,
                'message'=>'tapylmady'
            ],404);
        }
        return response()->json([
            'success'=>true,
            'data'=>$airport,
        ]);
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|size:3|unique:airports,code',
            'city' => 'required|string|max:255',
        ]);

        $airport = Airport::create($validated);

        return response()->json([
            'message' => 'Airport created successfully!',
            'airport' => $airport
        ], 201);
    }
    public function destroy($id)
    {
        $airport = Airport::find($id);
        
        if (!$airport) {
            return response()->json([
                'success' => false,
                'message' => 'Аэропорт не найден'
            ], 404);
        }
        $airport->delete();
        return response()->json([
            'message' => 'Airport deleted successfully!'
        ]);
    }
}
