<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Area;

class AreaController extends Controller
{
    //
    public function index()
    {
        $areas = Area::all();

        return view('area.index', compact('areas'));
    }

    // Mostrar formulario para crear
    public function create()
    {
        return view('area.create');
    }

    // Guardar área
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
        ]);

        Area::create([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
        ]);

        return redirect()
            ->route('areas.index')
            ->with('success', 'Área registrada correctamente.');
    }

    // Mostrar formulario de edición
    public function edit(Area $area)
    {
        return view('area.edit', compact('area'));
    }

    // Actualizar área
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

        return redirect()
            ->route('areas.index')
            ->with('success', 'Área actualizada correctamente.');
    }

    // Eliminar área
    public function destroy(Area $area)
    {
        $area->delete();

        return redirect()
            ->route('areas.index')
            ->with('success', 'Área eliminada correctamente.');
    }
}
