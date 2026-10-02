<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Apprentice;
use App\Models\Course;
use App\Models\Computer;

class ApprenticeController extends Controller
{
   // Listar todos los aprendices con sus relaciones para la App Móvil
    public function index()
    {
        $apprentices = Apprentice::with(['course', 'computer'])->get();

        return response()->json([
            'success' => true,
            'data' => $apprentices
        ], 200);
    }

    // Registrar un nuevo aprendiz desde la App Móvil (soporta subida de foto)
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:apprentices,email',
            'cell_number' => 'required|string|max:255',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'course_id' => 'required|exists:courses,id',
            'computer_id' => 'nullable|exists:computers,id',
        ]);

        if ($request->hasFile('photo')) {
            $validated['photo'] = $request->file('photo')->store('apprentices', 'public');
        }

        $apprentice = Apprentice::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Aprendiz registrado correctamente.',
            'data' => $apprentice->load(['course', 'computer'])
        ], 201);
    }

    // Consultar un solo aprendiz por ID desde la App Móvil
    public function show(Apprentice $apprentice)
    {
        return response()->json([
            'success' => true,
            'data' => $apprentice->load(['course', 'computer'])
        ], 200);
    }

    // Actualizar un aprendiz desde la App Móvil
    public function update(Request $request, Apprentice $apprentice)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:apprentices,email,' . $apprentice->id,
            'cell_number' => 'required|string|max:255',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'course_id' => 'required|exists:courses,id',
            'computer_id' => 'nullable|exists:computers,id',
        ]);

        if ($request->hasFile('photo')) {
            if ($apprentice->photo) {
                Storage::disk('public')->delete($apprentice->photo);
            }

            $validated['photo'] = $request->file('photo')->store('apprentices', 'public');
        }

        $apprentice->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Aprendiz actualizado correctamente.',
            'data' => $apprentice->load(['course', 'computer'])
        ], 200);
    }

    // Eliminar un aprendiz desde la App Móvil
    public function destroy(Apprentice $apprentice)
    {
        if ($apprentice->photo) {
            Storage::disk('public')->delete($apprentice->photo);
        }

        $apprentice->delete();

        return response()->json([
            'success' => true,
            'message' => 'Aprendiz eliminado correctamente.'
        ], 200);
    }
}