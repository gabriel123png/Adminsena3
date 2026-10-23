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

        if (! request()->expectsJson()) {
            return view('course.index', compact('courses'));
        }

        return response()->json([
            'success' => true,
            'data' => $courses
        ], 200);
    }

    // Registrar un nuevo curso desde la App Móvil
    public function store(Request $request)
    {
        $validated = $request->validate([
            'course_number' => 'required|string|max:255',
            'day' => 'required|string|max:255',
            'area_id' => 'required|exists:areas,id',
            'training_center_id' => 'required|exists:training_centers,id',
        ]);

        $course = Course::create($validated);

        if (! $request->expectsJson()) {
            return redirect()->route('courses.index')->with('success', 'Curso registrado correctamente.');
        }

        return response()->json([
            'success' => true,
            'message' => 'Curso registrado correctamente.',
            'data' => $course->load(['area', 'trainingCenter'])
        ], 201);
    }

    // Consultar un solo curso por ID desde la App Móvil
    public function show(Course $course)
    {
        if (! request()->expectsJson()) {
            return redirect()->route('courses.index');
        }

        return response()->json([
            'success' => true,
            'data' => $course->load(['area', 'trainingCenter'])
        ], 200);
    }

    public function create()
    {
        $areas = Area::orderBy('nombre')->get();
        $trainingCenters = Training_center::orderBy('name')->get();

        return view('course.create', compact('areas', 'trainingCenters'));
    }

    public function edit(Course $course)
    {
        $areas = Area::orderBy('nombre')->get();
        $trainingCenters = Training_center::orderBy('name')->get();

        return view('course.edit', compact('course', 'areas', 'trainingCenters'));
    }

    // Actualizar un curso desde la App Móvil
    public function update(Request $request, Course $course)
    {
        $validated = $request->validate([
            'course_number' => 'required|string|max:255',
            'day' => 'required|string|max:255',
            'area_id' => 'required|exists:areas,id',
            'training_center_id' => 'required|exists:training_centers,id',
        ]);

        $course->update($validated);

        if (! $request->expectsJson()) {
            return redirect()->route('courses.index')->with('success', 'Curso actualizado correctamente.');
        }

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

        if (! request()->expectsJson()) {
            return redirect()->route('courses.index')->with('success', 'Curso eliminado correctamente.');
        }

        return response()->json([
            'success' => true,
            'message' => 'Curso eliminado correctamente.'
        ], 200);
    }
}