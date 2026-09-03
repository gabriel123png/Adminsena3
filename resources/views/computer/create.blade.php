@extends('layouts.app')

@section('title', 'Nuevo Computador')

@section('content')

<div class="card">

    <div class="card-header">
        <h1>Registrar Computador</h1>
    </div>

    <div class="card-body">

        <form action="{{ route('computers.store') }}" method="POST">

            @csrf

            <div class="mb-3">

                <label class="form-label">
                    Número
                </label>

                <input
                    type="text"
                    name="number"
                    class="form-control"
                    value="{{ old('number') }}"
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
                    value="{{ old('brand') }}"
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

                Guardar

            </button>

        </form>

    </div>

</div>

@endsection
