@extends('layouts.app')

@section('title', 'Nueva Área')

@section('content')

<div class="card">

    <div class="card-header">
        <h1>Registrar Área</h1>
    </div>

    <div class="card-body">

        {{-- 1. AGREGA enctype="multipart/form-data" AQUÍ --}}
        <form action="{{ route('areas.store') }}" method="POST" enctype="multipart/form-data">

            @csrf

            <div class="mb-3">
                <label class="form-label">
                    Nombre
                </label>

                <input
                    type="text"
                    name="nombre"
                    class="form-control"
                    value="{{ old('nombre') }}"
                    required>
            </div>

            <div class="mb-3">
                <label class="form-label">
                    Descripción
                </label>

                <textarea
                    name="descripcion"
                    class="form-control"
                    rows="4">{{ old('descripcion') }}</textarea>
            </div>

            {{-- 2. AGREGA ESTE BLOQUE PARA EL CAMPO DE LA IMAGEN --}}
            <div class="mb-3">
                <label class="form-label">
                    Imagen del Área
                </label>

                <input
                    type="file"
                    name="imagen"
                    class="form-control"
                    accept="image/*"
                    required>
            </div>

            <a
                href="{{ route('areas.index') }}"
                class="btn btn-secondary">
                Cancelar
            </a>

            <button
                type="submit"
                class="btn btn-success">
                Guardar
            </button>

        </form>

    </div>

</div>

@endsection