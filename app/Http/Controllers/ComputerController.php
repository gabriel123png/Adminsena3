<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Computer;

class ComputerController extends Controller
{
    // Mostrar lista de computadores
    public function index()
    {
        $computers = Computer::all();

        return view('computer.index', compact('computers'));
    }

    // Mostrar formulario para crear
    public function create()
    {
        return view('computer.create');
    }

    // Guardar computador
    public function store(Request $request)
    {
        $request->validate([
            'number' => 'required|string|max:255',
            'brand' => 'required|string|max:255',
        ]);

        Computer::create([
            'number' => $request->number,
            'brand' => $request->brand,
        ]);

        return redirect()
            ->route('computers.index')
            ->with('success', 'Computador registrado correctamente.');
    }

    // Mostrar detalles de un computador
    public function show(Computer $computer)
    {
        return view('computer.show', compact('computer'));
    }

    // Mostrar formulario de edición
    public function edit(Computer $computer)
    {
        return view('computer.edit', compact('computer'));
    }

    // Actualizar computador
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

        return redirect()
            ->route('computers.index')
            ->with('success', 'Computador actualizado correctamente.');
    }

    // Eliminar computador
    public function destroy(Computer $computer)
    {
        $computer->delete();

        return redirect()
            ->route('computers.index')
            ->with('success', 'Computador eliminado correctamente.');
    }
}
