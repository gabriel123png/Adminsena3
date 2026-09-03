<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Area;
use App\Models\Training_center;

class CourseController extends Controller
{
    // Mostrar lista de cursos
    public function index()
    {
        $courses = Course::with(['area', 'trainingCenter'])->get();

        return view('course.index', compact('courses'));
    }

    // Mostrar formulario para crear
    public function create()
    {
        $areas = Area::all();
        $trainingCenters = Training_center::all();

        return view('course.create', compact('areas', 'trainingCenters'));
    }

    // Guardar curso
    public function store(Request $request)
    {
        $request->validate([
            'course_number' => 'required|string|max:255',
            'day' => 'required|string|max:255',
            'area_id' => 'required|exists:areas,id',
            'training_center_id' => 'required|exists:training_centers,id',
        ]);

        Course::create([
            'course_number' => $request->course_number,
            'day' => $request->day,
            'area_id' => $request->area_id,
            'training_center_id' => $request->training_center_id,
        ]);

        return redirect()
            ->route('courses.index')
            ->with('success', 'Curso registrado correctamente.');
    }

    // Mostrar detalles de un curso
    public function show(Course $course)
    {
        return view('course.show', compact('course'));
    }

    // Mostrar formulario de edición
    public function edit(Course $course)
    {
        $areas = Area::all();
        $trainingCenters = Training_center::all();

        return view('course.edit', compact('course', 'areas', 'trainingCenters'));
    }

    // Actualizar curso
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

        return redirect()
            ->route('courses.index')
            ->with('success', 'Curso actualizado correctamente.');
    }

    // Eliminar curso
    public function destroy(Course $course)
    {
        $course->delete();

        return redirect()
            ->route('courses.index')
            ->with('success', 'Curso eliminado correctamente.');
    }
}
