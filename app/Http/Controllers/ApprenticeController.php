<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Apprentice;
use App\Models\Course;
use App\Models\Computer;

class ApprenticeController extends Controller
{
    public function index()
    {
        $apprentices = Apprentice::with(['course', 'computer'])->get();

        return view('apprentice.index', compact('apprentices'));
    }

    public function create()
    {
        $courses = Course::all();
        $computers = Computer::all();

        return view('apprentice.create', compact('courses', 'computers'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:apprentices,email',
            'cell_number' => 'required|string|max:255',
            'course_id' => 'required|exists:courses,id',
            'computer_id' => 'nullable|exists:computers,id',
        ]);

        Apprentice::create($validated);

        return redirect()
            ->route('apprentices.index')
            ->with('success', 'Aprendiz registrado correctamente.');
    }

    public function show(Apprentice $apprentice)
    {
        return view('apprentice.show', compact('apprentice'));
    }

    public function edit(Apprentice $apprentice)
    {
        $courses = Course::all();
        $computers = Computer::all();

        return view('apprentice.edit', compact('apprentice', 'courses', 'computers'));
    }

    public function update(Request $request, Apprentice $apprentice)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:apprentices,email,' . $apprentice->id,
            'cell_number' => 'required|string|max:255',
            'course_id' => 'required|exists:courses,id',
            'computer_id' => 'nullable|exists:computers,id',
        ]);

        $apprentice->update($validated);

        return redirect()
            ->route('apprentices.index')
            ->with('success', 'Aprendiz actualizado correctamente.');
    }

    public function destroy(Apprentice $apprentice)
    {
        $apprentice->delete();

        return redirect()
            ->route('apprentices.index')
            ->with('success', 'Aprendiz eliminado correctamente.');
    }
}
