<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Area;
use App\Models\Training_center;

class CourseController extends Controller
{
    // Listar todos los cursos con sus relaciones para la App Móvil
    public function index()
    {
        $courses = Course::with(['area', 'trainingCenter'])->get();

        return response()->json([
            'success' => true,
            'data' => $courses
        ], 200);
    }

    // Registrar un nuevo curso desde la App Móvil
    public function store(Request $request)
    {
        $request->validate([
            'course_number' => 'required|string|max:255',
            'day' => 'required|string|max:255',
            'area_id' => 'required|exists:areas,id',
            'training_center_id' => 'required|exists:training_centers,id',
        ]);

        $course = Course::create([
            'course_number' => $request->course_number,
            'day' => $request->day,
            'area_id' => $request->area_id,
            'training_center_id' => $request->training_center_id,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Curso registrado correctamente.',
            'data' => $course->load(['area', 'trainingCenter'])
        ], 201);
    }

    // Consultar un solo curso por ID desde la App Móvil
    public function show(Course $course)
    {
        return response()->json([
            'success' => true,
            'data' => $course->load(['area', 'trainingCenter'])
        ], 200);
    }

    // Actualizar un curso desde la App Móvil
    public function update(Request $request, Course $course)
    {
        $request->validate([
            'course_number' => 'required|string|max:255',
            'day' => 'required|string|max:255',
            'area_id' => 'required|exists:areas,id',
            'training_center_id' => 'required|exists:training_centers,id',
        ]);

        $course->update([
            'course_number' => $request->course_number,
            'day' => $request->day,
            'area_id' => $request->area_id,
            'training_center_id' => $request->training_center_id,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Curso actualizado correctamente.',
            'data' => $course->load(['area', 'trainingCenter'])
        ], 200);
    }

    // Eliminar un curso desde la App Móvil
    public function destroy(Course $course)
    {
        $course->delete();

        return response()->json([
            'success' => true,
            'message' => 'Curso eliminado correctamente.'
        ], 200);
    }
}