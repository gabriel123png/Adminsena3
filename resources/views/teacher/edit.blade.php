@extends('layouts.app')

@section('title', 'Editar Instructor')

@section('content')

<div class="card">

    <div class="card-header">
        <h1>Editar Instructor</h1>
    </div>

    <div class="card-body">

        <form action="{{ route('teachers.update', $teacher->id) }}" method="POST">

            @csrf
            @method('PUT')

            <div class="mb-3">

                <label class="form-label">
                    Nombre
                </label>

                <input
                    type="text"
                    name="name"
                    class="form-control"
                    value="{{ old('name', $teacher->name) }}"
                    required>

                @error('name')
                    <div class="text-danger">{{ $message }}</div>
                @enderror

            </div>

            <div class="mb-3">

                <label class="form-label">
                    Email
                </label>

                <input
                    type="email"
                    name="email"
                    class="form-control"
                    value="{{ old('email', $teacher->email) }}"
                    required>

                @error('email')
                    <div class="text-danger">{{ $message }}</div>
                @enderror

            </div>

            <div class="mb-3">

                <label class="form-label">
                    Área
                </label>

                <select
                    name="area_id"
                    class="form-control"
                    required>

                    <option value="">-- Seleccione un área --</option>

                    @foreach($areas as $area)
                        <option value="{{ $area->id }}" {{ $teacher->area_id == $area->id ? 'selected' : '' }}>
                            {{ $area->nombre }}
                        </option>
                    @endforeach

                </select>

                @error('area_id')
                    <div class="text-danger">{{ $message }}</div>
                @enderror

            </div>

            <div class="mb-3">

                <label class="form-label">
                    Centro de Formación
                </label>

                <select
                    name="training_center_id"
                    class="form-control"
                    required>

                    <option value="">-- Seleccione un centro --</option>

                    @foreach($trainingCenters as $center)
                        <option value="{{ $center->id }}" {{ $teacher->training_center_id == $center->id ? 'selected' : '' }}>
                            {{ $center->name }}
                        </option>
                    @endforeach

                </select>

                @error('training_center_id')
                    <div class="text-danger">{{ $message }}</div>
                @enderror

            </div>

            <a
                href="{{ route('teachers.index') }}"
                class="btn btn-secondary">

                Cancelar

            </a>

            <button
                type="submit"
                class="btn btn-success">

                Actualizar

            </button>

        </form>

    </div>

</div>

@endsection
