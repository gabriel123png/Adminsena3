@extends('layouts.app')

@section('title', 'Detalle del Aprendiz')

@section('content')
<div class="card">
    <div class="card-header"><h1>Detalle del Aprendiz</h1></div>
    <div class="card-body">
        <dl class="row">
            <dt class="col-sm-3">Nombre</dt><dd class="col-sm-9">{{ $apprentice->name }}</dd>
            <dt class="col-sm-3">Email</dt><dd class="col-sm-9">{{ $apprentice->email }}</dd>
            <dt class="col-sm-3">Celular</dt><dd class="col-sm-9">{{ $apprentice->cell_number }}</dd>
            <dt class="col-sm-3">Curso</dt><dd class="col-sm-9">{{ $apprentice->course->course_number ?? 'N/A' }}</dd>
            <dt class="col-sm-3">Computador</dt><dd class="col-sm-9">{{ $apprentice->computer->number ?? 'Sin asignar' }}</dd>
        </dl>
        <a href="{{ route('apprentices.index') }}" class="btn btn-secondary">Volver</a>
        <a href="{{ route('apprentices.edit', $apprentice) }}" class="btn btn-warning">Editar</a>
    </div>
</div>
@endsection
