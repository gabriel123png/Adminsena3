<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;


use App\Models\Area;
use Cloudinary\Cloudinary;

class AreaController extends Controller
{

   
    // Listar todas las áreas para la App Móvil
    public function index()
    {
        $areas = Area::all();

        if (! request()->expectsJson()) {
            return view('area.index', compact('areas'));
        }

        return response()->json([
            'success' => true,
            'data' => $areas
        ], 200);
    }

    // Registrar una nueva área desde la App Móvil
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'imagen' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
        ]);

        $validated['descripcion'] = $validated['descripcion'] ?? '';
        if ($request->hasFile('imagen')) {
            $cloudinary = new Cloudinary([
                'cloud' => [
                    'cloud_name' => config('services.cloudinary.cloud_name'),
                    'api_key' => config('services.cloudinary.api_key'),
                    'api_secret' => config('services.cloudinary.api_secret'),
                ],
                'url' => ['secure' => true],
            ]);
            $image = $cloudinary->uploadApi()->upload($request->file('imagen')->getRealPath());
            $validated['imagen_url'] = $image['secure_url'];
            $validated['imagen_public_id'] = $image['public_id'];
        }

        unset($validated['imagen']);
        $area = Area::create($validated);
        // 1. Validar los campos y la imagen con los nombres que usas ('nombre', 'descripcion', 'imagen')
        $request->validate([
            'name' => 'required|string|max:255',
            'imagen' => 'required|image|mimes:jpg,jpeg,png,webp|max:5120',
        ]);

        $file = $request->file('imagen');

        $cloudinary = new Cloudinary([
            'cloud' => [
                'cloud_name' => config('services.cloudinary.cloud_name'),
                'api_key' => config('services.cloudinary.api_key'),
                'api_secret' => config('services.cloudinary.api_secret'),
            ],
            'url' => ['secure' => true],
        ]);

        $resultado = $cloudinary->uploadApi()->upload(
            $file->getRealPath(),
            [
                'folder' => 'area',
                'resource_type' => 'image',
            ]
        );

        $area = Area::create([
            'name' => $request->name,
            'imagen_url' => $resultado['secure_url'],
            'imagen_public_id' => $resultado['public_id'],
        ]);

        return response()->json([
            'message' => 'Area creada correctamente',
            'data' => $area,
        ], 201);
    }

    // Consultar una sola área por ID desde la App Móvil
    public function show(Area $area)
    {
        if (! request()->expectsJson()) {
            return redirect()->route('areas.index');
        }

        return response()->json([
            'success' => true,
            'data' => $area
        ], 200);
    }

    public function create()
    {
        return view('area.create');
    }

    public function edit(Area $area)
    {
        return view('area.edit', compact('area'));
    }

    // Actualizar una área desde la App Móvil
    public function update(Request $request, Area $area)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
        ]);

        $validated['descripcion'] = $validated['descripcion'] ?? '';
        $area->update($validated);

        if (! $request->expectsJson()) {
            return redirect()->route('areas.index')->with('success', 'Área actualizada correctamente.');
        }

        return response()->json([
            'success' => true,
            'message' => 'Área actualizada correctamente.',
            'data' => $area
        ], 200);
    }

    // Eliminar una área desde la App Móvil
    public function destroy(Area $area)
    {
        $area->delete();

        if (! request()->expectsJson()) {
            return redirect()->route('areas.index')->with('success', 'Área eliminada correctamente.');
        }

        return response()->json([
            'success' => true,
            'message' => 'Área eliminada correctamente.'
        ], 200);
    }
}
