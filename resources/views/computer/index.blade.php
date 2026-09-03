@extends('layouts.app')

@section('title', 'Computadores')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">

    <h1>Computadores</h1>

    <a href="{{ route('computers.create') }}" class="btn btn-success">
        Nuevo Computador
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
                    <th>Número</th>
                    <th>Marca</th>
                    <th>Acciones</th>
                </tr>

            </thead>

            <tbody>

                @forelse($computers as $computer)

                    <tr>

                        <td>{{ $computer->id }}</td>

                        <td>{{ $computer->number }}</td>

                        <td>{{ $computer->brand }}</td>

                        <td>

                            <a
                                href="{{ route('computers.edit', $computer->id) }}"
                                class="btn btn-warning btn-sm">

                                Editar

                            </a>

                            <form
                                action="{{ route('computers.destroy', $computer->id) }}"
                                method="POST"
                                style="display:inline">

                                @csrf
                                @method('DELETE')

                                <button
                                    type="submit"
                                    class="btn btn-danger btn-sm"
                                    onclick="return confirm('¿Desea eliminar este computador?')">

                                    Eliminar

                                </button>

                            </form>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="4" class="text-center">

                            No hay computadores registrados.

                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection
