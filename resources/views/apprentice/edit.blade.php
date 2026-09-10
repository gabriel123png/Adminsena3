@extends('layouts.app')

@section('title', 'Editar Aprendiz')

@section('content')
<div class="card">
    <div class="card-header"><h1>Editar Aprendiz</h1></div>
    <div class="card-body">
        <form action="{{ route('apprentices.update', $apprentice) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            @include('apprentice.form')
            <a href="{{ route('apprentices.index') }}" class="btn btn-secondary">Cancelar</a>
            <button type="submit" class="btn btn-success">Actualizar</button>
        </form>
    </div>
</div>
@endsection
