<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

use App\Models\Area;

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
       
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'imagen' => 'required|image|mimes:jpg,jpeg,png,webp|max:5120',
        ]);

        $imagenUrl = null;
        $imagenPublicId = null;

        // 2. Si viene un archivo, aplicar tu lógica exacta de Cloudinary
        if ($request->hasFile('imagen')) {
            $file = $request->file('imagen');

            $cloudinary = new \Cloudinary\Cloudinary([
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
                    'folder' => 'adminsena3/areas', // Carpeta organizada
                    'resource_type' => 'image',
                ]
            );

            // Obtenemos los datos de la respuesta de Cloudinary
            $imagenUrl = $resultado['secure_url'];
            $imagenPublicId = $resultado['public_id'];
        }

        // 3. Preparar los datos que enviarás a tu API backend (o base de datos)
        $payload = [
            'nombre' => $request->input('nombre'),
            'descripcion' => $request->input('descripcion'),
            'imagen_url' => $imagenUrl,
            'imagen_public_id' => $imagenPublicId,
        ];

        
        $response = Http::acceptJson()->post($this->apiBaseUrl() . '/areas', $payload)->throw();

        // 5. Retornar según el tipo de respuesta (redirección web o JSON)
        if (! $request->expectsJson()) {
            return redirect()->route('areas.index')->with('success', '¡Área registrada correctamente!');
        }

        return response()->json([
            'success' => true,
            'message' => 'Área registrada correctamente.',
            'data' => $response->json() // o la data devuelta por tu API
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
