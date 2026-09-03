@extends('layouts.app')

@section('title', 'Inicio')

@section('content')

<div class="text-center">

    <h1 class="mb-4">
        Bienvenido a AdminSena
    </h1>

    <p class="lead">
        Sistema de administración del SENA
    </p>

</div>


<div class="row mt-5">


    <!-- Áreas -->
    <div class="col-md-4 mb-4">

        <div class="card shadow-sm">

            <div class="card-body text-center">

                <h5 class="card-title">
                    Áreas
                </h5>

                <p class="card-text">
                    Gestiona las áreas del SENA.
                </p>

                <a
                    href="{{ route('areas.index') }}"
                    class="btn btn-success">

                    Ver Áreas

                </a>

            </div>

        </div>

    </div>


    <!-- Centros -->
    <div class="col-md-4 mb-4">

        <div class="card shadow-sm">

            <div class="card-body text-center">

                <h5 class="card-title">
                    Centros de formación
                </h5>

                <p class="card-text">
                    Gestiona los centros de formación.
                </p>

                <a
                    href="{{ route('training_centers.index') }}"
                    class="btn btn-success">

                    Ver Centros

                </a>

            </div>

        </div>

    </div>


    <!-- Computadores -->
    <div class="col-md-4 mb-4">

        <div class="card shadow-sm">

            <div class="card-body text-center">

                <h5 class="card-title">
                    Computadores
                </h5>

                <p class="card-text">
                    Gestiona los computadores.
                </p>

                <a
                    href="{{ route('computers.index') }}"
                    class="btn btn-success">

                    Ver Computadores

                </a>

            </div>

        </div>

    </div>


    <!-- Instructores -->
    <div class="col-md-4 mb-4">

        <div class="card shadow-sm">

            <div class="card-body text-center">

                <h5 class="card-title">
                    Instructores
                </h5>

                <p class="card-text">
                    Gestiona los instructores.
                </p>

                <a
                    href="{{ route('teachers.index') }}"
                    class="btn btn-success">

                    Ver Instructores

                </a>

            </div>

        </div>

    </div>


    <!-- Cursos -->
    <div class="col-md-4 mb-4">

        <div class="card shadow-sm">

            <div class="card-body text-center">

                <h5 class="card-title">
                    Cursos
                </h5>

                <p class="card-text">
                    Gestiona los cursos.
                </p>

                <a
                    href="{{ route('courses.index') }}"
                    class="btn btn-success">

                    Ver Cursos

                </a>

            </div>

        </div>

    </div>


    <!-- Aprendices -->
    <div class="col-md-4 mb-4">

        <div class="card shadow-sm">

            <div class="card-body text-center">

                <h5 class="card-title">
                    Aprendices
                </h5>

                <p class="card-text">
                    Gestiona los aprendices.
                </p>

                <a
                    href="{{ route('apprentices.index') }}"
                    class="btn btn-success">

                    Ver Aprendices

                </a>

            </div>

        </div>

    </div>


</div>

@endsection