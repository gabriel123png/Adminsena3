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

        return response()->json([
            'success' => true,
            'data' => $areas
        ], 200);
    }

    // Registrar una nueva área desde la App Móvil
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
        ]);

        $area = Area::create([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Área registrada correctamente.',
            'data' => $area
        ], 201);
    }

    // Consultar una sola área por ID desde la App Móvil
    public function show(Area $area)
    {
        return response()->json([
            'success' => true,
            'data' => $area
        ], 200);
    }

    // Actualizar una área desde la App Móvil
    public function update(Request $request, Area $area)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
        ]);

        $area->update([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
        ]);

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

        return response()->json([
            'success' => true,
            'message' => 'Área eliminada correctamente.'
        ], 200);
    }
}