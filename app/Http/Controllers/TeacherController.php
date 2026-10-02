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

        return response()->json([
            'success' => true,
            'data' => $teachers
        ], 200);
    }

    // Registrar un nuevo instructor desde la App Móvil
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:teachers,email',
            'area_id' => 'required|exists:areas,id',
            'training_center_id' => 'required|exists:training_centers,id',
        ]);

        $teacher = Teacher::create([
            'name' => $request->name,
            'email' => $request->email,
            'area_id' => $request->area_id,
            'training_center_id' => $request->training_center_id,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Instructor registrado correctamente.',
            'data' => $teacher->load(['area', 'trainingCenter'])
        ], 201);
    }

    // Consultar un solo instructor por ID desde la App Móvil
    public function show(Teacher $teacher)
    {
        return response()->json([
            'success' => true,
            'data' => $teacher->load(['area', 'trainingCenter'])
        ], 200);
    }

    // Actualizar un instructor desde la App Móvil
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

        return response()->json([
            'success' => true,
            'message' => 'Instructor eliminado correctamente.'
        ], 200);
    }
}