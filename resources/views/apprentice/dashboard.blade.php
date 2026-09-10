@extends('layouts.app')

@section('title', 'Panel del Aprendiz')

@section('content')
<div class="text-center mb-5">
    <h1>Panel del Aprendiz</h1>
    <p class="lead">Bienvenido, {{ $apprentice->name ?? auth()->user()->name }}</p>
</div>

<div class="row justify-content-center">
    <div class="col-md-6 col-lg-4 mb-4">
        <div class="card shadow-sm h-100">
            <div class="card-body text-center">
                <h5 class="card-title">Mi cuenta</h5>
                @if($apprentice)
                    @if($apprentice->photo)
                        <img src="{{ asset('storage/' . $apprentice->photo) }}" alt="Foto de {{ $apprentice->name }}" class="rounded-circle mb-3" style="width: 120px; height: 120px; object-fit: cover;">
                    @else
                        <p class="text-muted">Sin foto</p>
                    @endif
                    <p class="card-text">Nombre: {{ $apprentice->name }}</p>
                    <p class="card-text">Correo: {{ $apprentice->email }}</p>
                    <p class="card-text">Celular: {{ $apprentice->cell_number }}</p>
                @else
                    <p class="card-text">Aún no hay datos registrados para este correo.</p>
                @endif
            </div>
        </div>
    </div>

    <div class="col-md-6 col-lg-4 mb-4">
        <div class="card shadow-sm h-100">
            <div class="card-body text-center">
                <h5 class="card-title">Información SENA</h5>
                @if($apprentice)
                    <p class="card-text">Curso: {{ $apprentice->course->course_number ?? 'Sin curso' }}</p>
                    <p class="card-text">Computador: {{ $apprentice->computer->number ?? 'Sin asignar' }}</p>
                @else
                    <p class="card-text">Aquí aparecerán tus cursos y actividades.</p>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
