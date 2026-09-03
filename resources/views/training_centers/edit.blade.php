@extends('layouts.app')

@section('content')

<div class="container mt-4">

    <h2>Editar Centro de Formación</h2>

    <form action="{{ route('training_centers.update', $trainingCenter->id) }}"
          method="POST">

        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Nombre</label>

            <input type="text"
                   name="name"
                   class="form-control"
                   value="{{ $trainingCenter->name }}">

            @error('name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>


        <div class="mb-3">
            <label class="form-label">Ubicación</label>

            <input type="text"
                   name="location"
                   class="form-control"
                   value="{{ $trainingCenter->location }}">

            @error('location')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>


        <button type="submit" class="btn btn-primary">
            Actualizar
        </button>

        <a href="{{ route('training_centers.index') }}"
           class="btn btn-secondary">
            Cancelar
        </a>

    </form>

</div>

@endsection