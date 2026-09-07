@extends('layouts.app')

@section('title', 'Inicio')

@section('content')

@guest
<div class="row justify-content-center">
    <div class="col-md-6 col-lg-5">
        <div class="card shadow-sm">
            <div class="card-body p-4">
                <h1 class="h3 text-center mb-4">Iniciar sesión</h1>

                @if(session('status'))
                    <div class="alert alert-success">{{ session('status') }}</div>
                @endif

                <form action="{{ route('login.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="email" class="form-label">Correo o usuario</label>
                        <input id="email" type="text" name="email" class="form-control" value="{{ old('email') }}" required autofocus>
                        @error('email')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Contraseña</label>
                        <input id="password" type="password" name="password" class="form-control" required>
                        @error('password')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                    </div>

                    <div class="mb-3">
                        <label for="role" class="form-label">Ingresar como</label>
                        <select id="role" name="role" class="form-select" required>
                            <option value="">-- Selecciona una opción --</option>
                            <option value="admin" {{ old('role') === 'admin' ? 'selected' : '' }}>Administrador</option>
                            <option value="aprendiz" {{ old('role') === 'aprendiz' ? 'selected' : '' }}>Aprendiz SENA</option>
                        </select>
                        @error('role')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                    </div>

                    <div class="form-check mb-3">
                        <input id="remember" type="checkbox" name="remember" class="form-check-input" value="1">
                        <label for="remember" class="form-check-label">Recordar mi sesión</label>
                    </div>

                    <button type="submit" class="btn btn-success w-100">Ingresar</button>
                </form>
            </div>
        </div>
    </div>
</div>
@else
@if(auth()->user()->role === 'aprendiz')
<div class="text-center">
    <h1 class="mb-4">Bienvenido, aprendiz</h1>
    <p class="lead">Has iniciado sesión como aprendiz del SENA.</p>
</div>
@else
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
@endif

@endguest
@endsection