<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course_teacher as CourseTeacher;
use App\Models\Course;
use App\Models\Teacher;

class CourseTeacherController extends Controller
{
    public function create()
    {
        return response()->json([
            'success' => true,
            'data' => [
                'courses' => Course::orderBy('course_number')->get(['id', 'course_number']),
                'teachers' => Teacher::orderBy('name')->get(['id', 'name']),
            ],
        ]);
    }

    // Listar todas las asignaciones de cursos e instructores
    public function index()
    {
        $courseTeachers = CourseTeacher::with(['course', 'teacher'])->get();

        return response()->json([
            'success' => true,
            'data' => $courseTeachers
        ], 200);
    }

    // Asignar un profesor a un curso
    public function store(Request $request)
    {
        $request->validate([
            'course_id' => 'required|exists:courses,id',
            'teacher_id' => 'required|exists:teachers,id',
        ]);

        $courseTeacher = CourseTeacher::create([
            'course_id' => $request->course_id,
            'teacher_id' => $request->teacher_id,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Profesor asignado al curso correctamente.',
            'data' => $courseTeacher->load(['course', 'teacher'])
        ], 201);
    }

    // Consultar una asignación específica por ID
    public function show(CourseTeacher $courseTeacher)
    {
        return response()->json([
            'success' => true,
            'data' => $courseTeacher->load(['course', 'teacher'])
        ], 200);
    }

    // Actualizar la asignación de curso o profesor
    public function update(Request $request, CourseTeacher $courseTeacher)
    {
        $request->validate([
            'course_id' => 'required|exists:courses,id',
            'teacher_id' => 'required|exists:teachers,id',
        ]);

        $courseTeacher->update([
            'course_id' => $request->course_id,
            'teacher_id' => $request->teacher_id,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Asignación actualizada correctamente.',
            'data' => $courseTeacher->load(['course', 'teacher'])
        ], 200);
    }

    // Eliminar la asignación de un profesor a un curso
    public function destroy(CourseTeacher $courseTeacher)
    {
        $courseTeacher->delete();

        return response()->json([
            'success' => true,
            'message' => 'Asignación eliminada correctamente.'
        ], 200);
    }
}
