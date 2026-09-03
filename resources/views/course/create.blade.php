@extends('layouts.app')

@section('title', 'Nuevo Curso')

@section('content')

<div class="card">

    <div class="card-header">
        <h1>Registrar Curso</h1>
    </div>

    <div class="card-body">

        <form action="{{ route('courses.store') }}" method="POST">

            @csrf

            <div class="mb-3">

                <label class="form-label">
                    Número de Curso
                </label>

                <input
                    type="text"
                    name="course_number"
                    class="form-control"
                    value="{{ old('course_number') }}"
                    required>

                @error('course_number')
                    <div class="text-danger">{{ $message }}</div>
                @enderror

            </div>

            <div class="mb-3">

                <label class="form-label">
                    Día
                </label>

                <input
                    type="text"
                    name="day"
                    class="form-control"
                    value="{{ old('day') }}"
                    required>

                @error('day')
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
                        <option value="{{ $area->id }}">{{ $area->nombre }}</option>
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
                        <option value="{{ $center->id }}">{{ $center->name }}</option>
                    @endforeach

                </select>

                @error('training_center_id')
                    <div class="text-danger">{{ $message }}</div>
                @enderror

            </div>

            <a
                href="{{ route('courses.index') }}"
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
