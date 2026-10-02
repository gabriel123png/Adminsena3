<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Computer;

class ComputerController extends Controller
{
    // Listar todos los computadores para la App Móvil
    public function index()
    {
        $computers = Computer::all();

        return response()->json([
            'success' => true,
            'data' => $computers
        ], 200);
    }

    // Registrar un nuevo computador desde la App Móvil
    public function store(Request $request)
    {
        $request->validate([
            'number' => 'required|string|max:255',
            'brand' => 'required|string|max:255',
        ]);

        $computer = Computer::create([
            'number' => $request->number,
            'brand' => $request->brand,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Computador registrado correctamente.',
            'data' => $computer
        ], 201);
    }

    // Consultar un solo computador por ID desde la App Móvil
    public function show(Computer $computer)
    {
        return response()->json([
            'success' => true,
            'data' => $computer
        ], 200);
    }

    // Actualizar un computador desde la App Móvil
    public function update(Request $request, Computer $computer)
    {
        $request->validate([
            'number' => 'required|string|max:255',
            'brand' => 'required|string|max:255',
        ]);

        $computer->update([
            'number' => $request->number,
            'brand' => $request->brand,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Computador actualizado correctamente.',
            'data' => $computer
        ], 200);
    }

    // Eliminar un computador desde la App Móvil
    public function destroy(Computer $computer)
    {
        $computer->delete();

        return response()->json([
            'success' => true,
            'message' => 'Computador eliminado correctamente.'
        ], 200);
    }
}