<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Teacher;
use App\Models\Area;
use App\Models\Training_center;

class TeacherController extends Controller
{
    // Mostrar lista de instructores
    public function index()
    {
        $teachers = Teacher::with(['area', 'trainingCenter'])->get();

        return view('teacher.index', compact('teachers'));
    }

    // Mostrar formulario para crear
    public function create()
    {
        $areas = Area::all();
        $trainingCenters = Training_center::all();

        return view('teacher.create', compact('areas', 'trainingCenters'));
    }

    // Guardar instructor
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:teachers',
            'area_id' => 'required|exists:areas,id',
            'training_center_id' => 'required|exists:training_centers,id',
        ]);

        Teacher::create([
            'name' => $request->name,
            'email' => $request->email,
            'area_id' => $request->area_id,
            'training_center_id' => $request->training_center_id,
        ]);

        return redirect()
            ->route('teachers.index')
            ->with('success', 'Instructor registrado correctamente.');
    }

    // Mostrar detalles de un instructor
    public function show(Teacher $teacher)
    {
        return view('teacher.show', compact('teacher'));
    }

    // Mostrar formulario de edición
    public function edit(Teacher $teacher)
    {
        $areas = Area::all();
        $trainingCenters = Training_center::all();

        return view('teacher.edit', compact('teacher', 'areas', 'trainingCenters'));
    }

    // Actualizar instructor
    public function update(Request $request, Teacher $teacher)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:teachers,email,' . $teacher->id,
            'area_id' => 'required|exists:areas,id',
            'training_center_id' => 'required|exists:training_centers,id',
        ]);

        $teacher->update([
            'name' => $request->name,
            'email' => $request->email,
            'area_id' => $request->area_id,
            'training_center_id' => $request->training_center_id,
        ]);

        return redirect()
            ->route('teachers.index')
            ->with('success', 'Instructor actualizado correctamente.');
    }

    // Eliminar instructor
    public function destroy(Teacher $teacher)
    {
        $teacher->delete();

        return redirect()
            ->route('teachers.index')
            ->with('success', 'Instructor eliminado correctamente.');
    }
}
