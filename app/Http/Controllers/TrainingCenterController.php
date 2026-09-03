<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Training_center as TrainingCenter;

class TrainingCenterController extends Controller
{
    //
    public function index()
    {
        $trainingCenters = TrainingCenter::all();

        return view('training_centers.index', compact('trainingCenters'));
    }

    public function create()
    {
        return view('training_centers.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
        ]);

        TrainingCenter::create([
            'name' => $request->name,
            'location' => $request->location,
        ]);

        return redirect()
            ->route('training_centers.index')
            ->with('success', 'Centro de formación registrado correctamente.');
    }

    public function edit(TrainingCenter $trainingCenter)
    {
        return view('training_centers.edit', compact('trainingCenter'));
    }

    public function update(Request $request, TrainingCenter $trainingCenter)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
        ]);

        $trainingCenter->update([
            'name' => $request->name,
            'location' => $request->location,
        ]);

        return redirect()
            ->route('training_centers.index')
            ->with('success', 'Centro de formación actualizado correctamente.');
    }

    public function destroy(TrainingCenter $trainingCenter)
    {
        $trainingCenter->delete();

        return redirect()
            ->route('training_centers.index')
            ->with('success', 'Centro de formación eliminado correctamente.');
    }
}
