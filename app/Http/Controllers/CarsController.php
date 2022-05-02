<?php

namespace App\Http\Controllers;

use App\Models\Cars;
use Illuminate\Http\Request;

class CarsController extends Controller
{
    public function index()
    {
        return Cars::all();
    }

    public function show($id)
    {
        $data = Cars::find($id);
        if (!$data) {
            return response()->json([
                'message' => 'Record not found!'
            ], 404);
        } else {
            return $data;
        }
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'brand' => 'required|string',
            'model' => 'required|string',
            'year' => 'required|numeric',
        ]);
        $car = Cars::create($data);
        return response()->json($car, 201);
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'brand' => 'required|string',
            'model' => 'required|string',
            'year' => 'required|numeric',
        ]);
        $car = Cars::find($id);
        if (!$car) {
            return response()->json([
                'message' => 'Record not found!'
            ], 404);
        } else {
            $car->update($data);
            return response()->json($car, 200);
        }
    }

    public function destroy($id)
    {
        $car = Cars::find($id);
        if (!$car) {
            return response()->json([
                'message' => 'Record not found!'
            ], 404);
        } else {
            $car->delete();
            return response()->json([
                'message' => 'Record deleted!'
            ], 200);
        }
    }
}
