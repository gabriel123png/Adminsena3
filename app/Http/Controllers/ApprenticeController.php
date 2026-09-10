<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
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
            'photo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'course_id' => 'required|exists:courses,id',
            'computer_id' => 'nullable|exists:computers,id',
        ]);

        if ($request->hasFile('photo')) {
            $validated['photo'] = $request->file('photo')->store('apprentices', 'public');
        }

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

        return redirect()
            ->route('apprentices.index')
            ->with('success', 'Aprendiz actualizado correctamente.');
    }

    public function destroy(Apprentice $apprentice)
    {
        if ($apprentice->photo) {
            Storage::disk('public')->delete($apprentice->photo);
        }

        $apprentice->delete();

        return redirect()
            ->route('apprentices.index')
            ->with('success', 'Aprendiz eliminado correctamente.');
    }
}
