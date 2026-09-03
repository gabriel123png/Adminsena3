@extends('layouts.app')

@section('title', 'Cursos')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">

    <h1>Cursos</h1>

    <a href="{{ route('courses.create') }}" class="btn btn-success">
        Nuevo Curso
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
                    <th>Número de Curso</th>
                    <th>Día</th>
                    <th>Área</th>
                    <th>Centro de Formación</th>
                    <th>Acciones</th>
                </tr>

            </thead>

            <tbody>

                @forelse($courses as $course)

                    <tr>

                        <td>{{ $course->id }}</td>

                        <td>{{ $course->course_number }}</td>

                        <td>{{ $course->day }}</td>

                        <td>{{ $course->area->nombre ?? 'N/A' }}</td>

                        <td>{{ $course->trainingCenter->name ?? 'N/A' }}</td>

                        <td>

                            <a
                                href="{{ route('courses.edit', $course->id) }}"
                                class="btn btn-warning btn-sm">

                                Editar

                            </a>

                            <form
                                action="{{ route('courses.destroy', $course->id) }}"
                                method="POST"
                                style="display:inline">

                                @csrf
                                @method('DELETE')

                                <button
                                    type="submit"
                                    class="btn btn-danger btn-sm"
                                    onclick="return confirm('¿Desea eliminar este curso?')">

                                    Eliminar

                                </button>

                            </form>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="6" class="text-center">

                            No hay cursos registrados.

                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection
