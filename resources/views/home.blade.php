@extends('layouts.app')

@section('title', 'Inicio')

@section('content')

<style>
    .dashboard-card {
        animation: dashboard-card-in 450ms ease-out both;
        transition: transform 180ms ease, box-shadow 180ms ease;
    }

    .dashboard-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 0.75rem 1.5rem rgba(0, 0, 0, 0.14) !important;
    }

    .dashboard-grid > div:nth-child(1) .dashboard-card { animation-delay: 60ms; }
    .dashboard-grid > div:nth-child(2) .dashboard-card { animation-delay: 120ms; }
    .dashboard-grid > div:nth-child(3) .dashboard-card { animation-delay: 180ms; }
    .dashboard-grid > div:nth-child(4) .dashboard-card { animation-delay: 240ms; }
    .dashboard-grid > div:nth-child(5) .dashboard-card { animation-delay: 300ms; }
    .dashboard-grid > div:nth-child(6) .dashboard-card { animation-delay: 360ms; }

    @keyframes dashboard-card-in {
        from { opacity: 0; transform: translateY(18px); }
        to { opacity: 1; transform: translateY(0); }
    }

    @media (prefers-reduced-motion: reduce) {
        .dashboard-card { animation: none; transition: none; }
    }

    .sena-carousel-image {
        height: 260px;
        object-fit: cover;
    }

    @media (max-width: 576px) {
        .sena-carousel-image { height: 160px; }
    }
</style>

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
                        <label for="role" class="form-label">Ingresar como</label>
                        <select id="role" name="role" class="form-select" required>
                            <option value="">-- Selecciona una opción --</option>
                            <option value="admin" {{ old('role') === 'admin' ? 'selected' : '' }}>Administrador</option>
                            <option value="aprendiz" {{ old('role', 'aprendiz') === 'aprendiz' ? 'selected' : '' }}>Aprendiz SENA</option>
                        </select>
                        @error('role')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                    </div>

                    <div class="mb-3">
                        <label for="account" class="form-label">Selecciona tu nombre</label>
                        <select id="account" name="email" class="form-select" required autofocus>
                            <option value="">-- Selecciona tu nombre --</option>
                            @foreach($apprentices as $apprentice)
                                <option value="{{ $apprentice->email }}" data-role="aprendiz" {{ old('email', request()->cookie('remembered_email_aprendiz')) === $apprentice->email ? 'selected' : '' }}>
                                    {{ $apprentice->name }}
                                </option>
                            @endforeach
                            @foreach($administrators as $administrator)
                                <option value="{{ $administrator->email }}" data-role="admin" {{ old('email', request()->cookie('remembered_email_admin')) === $administrator->email ? 'selected' : '' }}>
                                    {{ $administrator->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('email')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Contraseña</label>
                        <input id="password" type="password" name="password" class="form-control" required>
                        @error('password')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                    </div>

                    <div class="form-check mb-3">
                        <input id="remember" type="checkbox" name="remember" class="form-check-input" value="1" {{ request()->cookie('remembered_email_' . old('role', 'aprendiz')) ? 'checked' : '' }}>
                        <label for="remember" class="form-check-label">Recordar mi sesión</label>
                    </div>

                    <button type="submit" class="btn btn-success w-100">Ingresar</button>
                </form>
                <script>
                    const roleField = document.getElementById('role');
                    const accountField = document.getElementById('account');
                    const rememberField = document.getElementById('remember');
                    const rememberedEmails = {
                        admin: @json(request()->cookie('remembered_email_admin')),
                        aprendiz: @json(request()->cookie('remembered_email_aprendiz'))
                    };

                    function updateAccounts() {
                        const selectedRole = roleField.value;
                        let hasSelectedAccount = false;

                        Array.from(accountField.options).forEach((option, index) => {
                            const isAvailable = index === 0 || option.dataset.role === selectedRole;
                            option.hidden = !isAvailable;
                            option.disabled = !isAvailable;

                            if (isAvailable && option.value === rememberedEmails[selectedRole]) {
                                option.selected = true;
                                hasSelectedAccount = true;
                            }
                        });

                        if (!hasSelectedAccount) {
                            accountField.selectedIndex = 0;
                        }

                        rememberField.checked = hasSelectedAccount;
                    }

                    roleField.addEventListener('change', () => {
                        updateAccounts();
                    });

                    updateAccounts();
                </script>
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

<div id="senaCarousel" class="carousel slide mt-4 mb-5" data-bs-ride="carousel" data-bs-interval="3000" data-bs-pause="hover">
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#senaCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Imagen 1"></button>
        <button type="button" data-bs-target="#senaCarousel" data-bs-slide-to="1" aria-label="Imagen 2"></button>
        <button type="button" data-bs-target="#senaCarousel" data-bs-slide-to="2" aria-label="Imagen 3"></button>
    </div>
    <div class="carousel-inner rounded shadow-sm">
        <div class="carousel-item active">
            <img src="https://images.unsplash.com/photo-1523240795612-9a054b0db644?auto=format&fit=crop&w=1400&q=80" class="d-block w-100 sena-carousel-image" alt="Estudiantes en formación">
            <div class="carousel-caption d-none d-md-block bg-dark bg-opacity-50 rounded">
                <h5>Formación para el futuro</h5>
                <p>Educación y oportunidades para todos.</p>
            </div>
        </div>
        <div class="carousel-item">
            <img src="https://images.unsplash.com/photo-1531482615713-2afd69097998?auto=format&fit=crop&w=1400&q=80" class="d-block w-100 sena-carousel-image" alt="Trabajo colaborativo en formación">
            <div class="carousel-caption d-none d-md-block bg-dark bg-opacity-50 rounded">
                <h5>Aprendizaje colaborativo</h5>
                <p>Construyendo conocimiento en equipo.</p>
            </div>
        </div>
        <div class="carousel-item">
            <img src="https://images.unsplash.com/photo-1516321318423-f06f85e504b3?auto=format&fit=crop&w=1400&q=80" class="d-block w-100 sena-carousel-image" alt="Tecnología y aprendizaje">
            <div class="carousel-caption d-none d-md-block bg-dark bg-opacity-50 rounded">
                <h5>Innovación y tecnología</h5>
                <p>Preparación para los nuevos desafíos.</p>
            </div>
        </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#senaCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Anterior</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#senaCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Siguiente</span>
    </button>
</div>


<div class="row mt-5 dashboard-grid">


    <!-- Áreas -->
    <div class="col-md-4 mb-4">

        <div class="card shadow-sm dashboard-card">

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

        <div class="card shadow-sm dashboard-card">

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

        <div class="card shadow-sm dashboard-card">

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

        <div class="card shadow-sm dashboard-card">

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

        <div class="card shadow-sm dashboard-card">

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

        <div class="card shadow-sm dashboard-card">

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