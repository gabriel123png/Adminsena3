<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Teacher;
use App\Models\Area;
use App\Models\Training_center;

class TeacherController extends Controller
{
   // Listar todos los instructores con sus relaciones para la App Móvil
    public function index()
    {
        $teachers = Teacher::with(['area', 'trainingCenter'])->get();

        if (! request()->expectsJson()) {
            return view('teacher.index', compact('teachers'));
        }

        return response()->json([
            'success' => true,
            'data' => $teachers
        ], 200);
    }

    // Registrar un nuevo instructor desde la App Móvil
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:teachers,email',
            'area_id' => 'required|exists:areas,id',
            'training_center_id' => 'required|exists:training_centers,id',
        ]);

        $teacher = Teacher::create($validated);

        if (! $request->expectsJson()) {
            return redirect()->route('teachers.index')->with('success', 'Instructor registrado correctamente.');
        }

        return response()->json([
            'success' => true,
            'message' => 'Instructor registrado correctamente.',
            'data' => $teacher->load(['area', 'trainingCenter'])
        ], 201);
    }

    // Consultar un solo instructor por ID desde la App Móvil
    public function show(Teacher $teacher)
    {
        if (! request()->expectsJson()) {
            return redirect()->route('teachers.index');
        }

        return response()->json([
            'success' => true,
            'data' => $teacher->load(['area', 'trainingCenter'])
        ], 200);
    }

    public function create()
    {
        $areas = Area::orderBy('nombre')->get();
        $trainingCenters = Training_center::orderBy('name')->get();

        return view('teacher.create', compact('areas', 'trainingCenters'));
    }

    public function edit(Teacher $teacher)
    {
        $areas = Area::orderBy('nombre')->get();
        $trainingCenters = Training_center::orderBy('name')->get();

        return view('teacher.edit', compact('teacher', 'areas', 'trainingCenters'));
    }

    // Actualizar un instructor desde la App Móvil
    public function update(Request $request, Teacher $teacher)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:teachers,email,' . $teacher->id,
            'area_id' => 'required|exists:areas,id',
            'training_center_id' => 'required|exists:training_centers,id',
        ]);

        $teacher->update($validated);

        if (! $request->expectsJson()) {
            return redirect()->route('teachers.index')->with('success', 'Instructor actualizado correctamente.');
        }

        return response()->json([
            'success' => true,
            'message' => 'Instructor actualizado correctamente.',
            'data' => $teacher->load(['area', 'trainingCenter'])
        ], 200);
    }

    // Eliminar un instructor desde la App Móvil
    public function destroy(Teacher $teacher)
    {
        $teacher->delete();

        if (! request()->expectsJson()) {
            return redirect()->route('teachers.index')->with('success', 'Instructor eliminado correctamente.');
        }

        return response()->json([
            'success' => true,
            'message' => 'Instructor eliminado correctamente.'
        ], 200);
    }
}