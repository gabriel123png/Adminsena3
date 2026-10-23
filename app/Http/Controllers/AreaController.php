<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Area;

class AreaController extends Controller
{
    // Listar todas las áreas para la App Móvil
    public function index()
    {
        $areas = Area::all();

        if (! request()->expectsJson()) {
            return view('area.index', compact('areas'));
        }

        return response()->json([
            'success' => true,
            'data' => $areas
        ], 200);
    }

    // Registrar una nueva área desde la App Móvil
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
        ]);

        $area = Area::create($validated);

        if (! $request->expectsJson()) {
            return redirect()->route('areas.index')->with('success', 'Área registrada correctamente.');
        }

        return response()->json([
            'success' => true,
            'message' => 'Área registrada correctamente.',
            'data' => $area
        ], 201);
    }

    // Consultar una sola área por ID desde la App Móvil
    public function show(Area $area)
    {
        if (! request()->expectsJson()) {
            return redirect()->route('areas.index');
        }

        return response()->json([
            'success' => true,
            'data' => $area
        ], 200);
    }

    public function create()
    {
        return view('area.create');
    }

    public function edit(Area $area)
    {
        return view('area.edit', compact('area'));
    }

    // Actualizar una área desde la App Móvil
    public function update(Request $request, Area $area)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
        ]);

        $area->update($validated);

        if (! $request->expectsJson()) {
            return redirect()->route('areas.index')->with('success', 'Área actualizada correctamente.');
        }

        return response()->json([
            'success' => true,
            'message' => 'Área actualizada correctamente.',
            'data' => $area
        ], 200);
    }

    // Eliminar una área desde la App Móvil
    public function destroy(Area $area)
    {
        $area->delete();

        if (! request()->expectsJson()) {
            return redirect()->route('areas.index')->with('success', 'Área eliminada correctamente.');
        }

        return response()->json([
            'success' => true,
            'message' => 'Área eliminada correctamente.'
        ], 200);
    }
}