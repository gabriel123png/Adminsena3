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

        if (! request()->expectsJson()) {
            return view('computer.index', compact('computers'));
        }

        return response()->json([
            'success' => true,
            'data' => $computers
        ], 200);
    }

    // Registrar un nuevo computador desde la App Móvil
    public function store(Request $request)
    {
        $validated = $request->validate([
            'number' => 'required|string|max:255',
            'brand' => 'required|string|max:255',
        ]);

        $computer = Computer::create($validated);

        if (! $request->expectsJson()) {
            return redirect()->route('computers.index')->with('success', 'Computador registrado correctamente.');
        }

        return response()->json([
            'success' => true,
            'message' => 'Computador registrado correctamente.',
            'data' => $computer
        ], 201);
    }

    // Consultar un solo computador por ID desde la App Móvil
    public function show(Computer $computer)
    {
        if (! request()->expectsJson()) {
            return redirect()->route('computers.index');
        }

        return response()->json([
            'success' => true,
            'data' => $computer
        ], 200);
    }

    public function create()
    {
        return view('computer.create');
    }

    public function edit(Computer $computer)
    {
        return view('computer.edit', compact('computer'));
    }

    // Actualizar un computador desde la App Móvil
    public function update(Request $request, Computer $computer)
    {
        $validated = $request->validate([
            'number' => 'required|string|max:255',
            'brand' => 'required|string|max:255',
        ]);

        $computer->update($validated);

        if (! $request->expectsJson()) {
            return redirect()->route('computers.index')->with('success', 'Computador actualizado correctamente.');
        }

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

        if (! request()->expectsJson()) {
            return redirect()->route('computers.index')->with('success', 'Computador eliminado correctamente.');
        }

        return response()->json([
            'success' => true,
            'message' => 'Computador eliminado correctamente.'
        ], 200);
    }
}