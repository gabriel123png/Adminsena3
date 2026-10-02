<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Training_center as TrainingCenter;

class TrainingCenterController extends Controller
{
    // Listar todos los centros de formación para la App Móvil
    public function index()
    {
        $trainingCenters = TrainingCenter::all();

        return response()->json([
            'success' => true,
            'data' => $trainingCenters
        ], 200);
    }

    // Registrar un nuevo centro de formación desde la App Móvil
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
        ]);

        $trainingCenter = TrainingCenter::create([
            'name' => $request->name,
            'location' => $request->location,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Centro de formación registrado correctamente.',
            'data' => $trainingCenter
        ], 201);
    }

    // Consultar un solo centro de formación por ID desde la App Móvil
    public function show(TrainingCenter $trainingCenter)
    {
        return response()->json([
            'success' => true,
            'data' => $trainingCenter
        ], 200);
    }

    // Actualizar un centro de formación desde la App Móvil
    public function update(Request $request, TrainingCenter $trainingCenter)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
        ]);

        $trainingCenter->update([
            'name' => $request->name,
            'location' => $request->location,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Centro de formación actualizado correctamente.',
            'data' => $trainingCenter
        ], 200);
    }

    // Eliminar un centro de formación desde la App Móvil
    public function destroy(TrainingCenter $trainingCenter)
    {
        $trainingCenter->delete();

        return response()->json([
            'success' => true,
            'message' => 'Centro de formación eliminado correctamente.'
        ], 200);
    }
}