@extends('layouts.app')

@section('content')

<div class="container mt-4">

    <h2>Registrar Centro de Formación</h2>

    <form action="{{ route('training_centers.store') }}" method="POST">

        @csrf

        <div class="mb-3">
            <label class="form-label">Nombre</label>

            <input type="text"
                   name="name"
                   class="form-control"
                   value="{{ old('name') }}">

            @error('name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>


        <div class="mb-3">
            <label class="form-label">Ubicación</label>

            <input type="text"
                   name="location"
                   class="form-control"
                   value="{{ old('location') }}">

            @error('location')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>


        <button type="submit" class="btn btn-success">
            Guardar
        </button>

        <a href="{{ route('training_centers.index') }}"
           class="btn btn-secondary">
            Cancelar
        </a>

    </form>

</div>

@endsection