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

        if (! request()->expectsJson()) {
            return view('training_centers.index', compact('trainingCenters'));
        }

        return response()->json([
            'success' => true,
            'data' => $trainingCenters
        ], 200);
    }

    // Registrar un nuevo centro de formación desde la App Móvil
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
        ]);

        $trainingCenter = TrainingCenter::create($validated);

        if (! $request->expectsJson()) {
            return redirect()->route('training_centers.index')->with('success', 'Centro de formación registrado correctamente.');
        }

        return response()->json([
            'success' => true,
            'message' => 'Centro de formación registrado correctamente.',
            'data' => $trainingCenter
        ], 201);
    }

    // Consultar un solo centro de formación por ID desde la App Móvil
    public function show(TrainingCenter $trainingCenter)
    {
        if (! request()->expectsJson()) {
            return redirect()->route('training_centers.index');
        }

        return response()->json([
            'success' => true,
            'data' => $trainingCenter
        ], 200);
    }

    public function create()
    {
        return view('training_centers.create');
    }

    public function edit(TrainingCenter $trainingCenter)
    {
        return view('training_centers.edit', compact('trainingCenter'));
    }

    // Actualizar un centro de formación desde la App Móvil
    public function update(Request $request, TrainingCenter $trainingCenter)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
        ]);

        $trainingCenter->update($validated);

        if (! $request->expectsJson()) {
            return redirect()->route('training_centers.index')->with('success', 'Centro de formación actualizado correctamente.');
        }

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

        if (! request()->expectsJson()) {
            return redirect()->route('training_centers.index')->with('success', 'Centro de formación eliminado correctamente.');
        }

        return response()->json([
            'success' => true,
            'message' => 'Centro de formación eliminado correctamente.'
        ], 200);
    }
}