@extends('layouts.app')

@section('title', 'Instructores')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">

    <h1>Instructores</h1>

    <a href="{{ route('teachers.create') }}" class="btn btn-success">
        Nuevo Instructor
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
                    <th>Email</th>
                    <th>Área</th>
                    <th>Centro de Formación</th>
                    <th>Acciones</th>
                </tr>

            </thead>

            <tbody>

                @forelse($teachers as $teacher)

                    <tr>

                        <td>{{ $teacher->id }}</td>

                        <td>{{ $teacher->name }}</td>

                        <td>{{ $teacher->email }}</td>

                        <td>{{ $teacher->area->nombre ?? 'N/A' }}</td>

                        <td>{{ $teacher->trainingCenter->name ?? 'N/A' }}</td>

                        <td>

                            <a
                                href="{{ route('teachers.edit', $teacher->id) }}"
                                class="btn btn-warning btn-sm">

                                Editar

                            </a>

                            <form
                                action="{{ route('teachers.destroy', $teacher->id) }}"
                                method="POST"
                                style="display:inline">

                                @csrf
                                @method('DELETE')

                                <button
                                    type="submit"
                                    class="btn btn-danger btn-sm"
                                    onclick="return confirm('¿Desea eliminar este instructor?')">

                                    Eliminar

                                </button>

                            </form>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="6" class="text-center">

                            No hay instructores registrados.

                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection
