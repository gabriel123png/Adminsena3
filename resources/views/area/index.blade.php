@extends('layouts.app')

@section('title', 'Áreas')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">

    <h1>Áreas</h1>

    <a href="{{ route('areas.create') }}" class="btn btn-success">
        Nueva Área
    </a>

</div>

@if(session('success'))

    <div class="alert alert-success">
        {{ session('success') }}
    </div>

@endif

<div class="card">

    <div class="card-body">

        <table class="table table-bordered table-striped">

            <thead>

                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Acciones</th>
                </tr>

            </thead>

            <tbody>

                @forelse($areas as $area)

                    <tr>

                        <td>{{ $area->id }}</td>

                        <td>{{ $area->nombre }}</td>

                        <td>{{ $area->descripcion }}</td>

                        <td>

                            <a
                                href="{{ route('areas.edit', $area->id) }}"
                                class="btn btn-warning btn-sm">

                                Editar

                            </a>

                            <form
                                action="{{ route('areas.destroy', $area->id) }}"
                                method="POST"
                                style="display:inline">

                                @csrf
                                @method('DELETE')

                                <button
                                    type="submit"
                                    class="btn btn-danger btn-sm"
                                    onclick="return confirm('¿Desea eliminar esta área?')">

                                    Eliminar

                                </button>

                            </form>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="4" class="text-center">

                            No hay áreas registradas.

                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection