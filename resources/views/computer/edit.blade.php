@extends('layouts.app')

@section('title', 'Editar Computador')

@section('content')

<div class="card">

    <div class="card-header">
        <h1>Editar Computador</h1>
    </div>

    <div class="card-body">

        <form action="{{ route('computers.update', $computer->id) }}" method="POST">

            @csrf
            @method('PUT')

            <div class="mb-3">

                <label class="form-label">
                    Número
                </label>

                <input
                    type="text"
                    name="number"
                    class="form-control"
                    value="{{ old('number', $computer->number) }}"
                    required>

            </div>

            <div class="mb-3">

                <label class="form-label">
                    Marca
                </label>

                <input
                    type="text"
                    name="brand"
                    class="form-control"
                    value="{{ old('brand', $computer->brand) }}"
                    required>

            </div>

            <a
                href="{{ route('computers.index') }}"
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
