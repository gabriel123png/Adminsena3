@extends('layouts.app')

@section('title', 'Inicio')

@section('content')

<style>
    .home-page {
        --sena-green: #39a900;
        --sena-dark-green: #247400;
        --sena-ink: #183126;
        --sena-muted: #617168;
    }

    .home-hero {
        position: relative;
        padding: clamp(2rem, 6vw, 4.5rem) 1.5rem;
        overflow: hidden;
        text-align: center;
        background:
            radial-gradient(circle at 10% 15%, rgba(57, 169, 0, .12), transparent 28%),
            linear-gradient(135deg, #f4faef 0%, #ffffff 55%, #eff8e9 100%);
        border: 1px solid #e3efdc;
        border-radius: 1.5rem;
    }

    .home-eyebrow {
        display: inline-flex;
        align-items: center;
        gap: .5rem;
        margin-bottom: 1rem;
        padding: .45rem .85rem;
        color: var(--sena-dark-green);
        font-size: .78rem;
        font-weight: 700;
        letter-spacing: .1em;
        text-transform: uppercase;
        background: #e6f4dd;
        border-radius: 999px;
    }

    .home-title {
        max-width: 760px;
        margin: 0 auto .75rem;
        color: var(--sena-ink);
        font-size: clamp(2rem, 5vw, 3.6rem);
        font-weight: 800;
        letter-spacing: -.045em;
        line-height: 1.08;
    }

    .home-title span {
        color: var(--sena-green);
    }

    .home-description {
        max-width: 620px;
        margin: 0 auto;
        color: var(--sena-muted);
        font-size: clamp(1rem, 2vw, 1.15rem);
        line-height: 1.7;
    }

    .home-section-heading {
        margin: 0 0 1.25rem;
        color: var(--sena-ink);
        font-size: clamp(1.35rem, 3vw, 1.8rem);
        font-weight: 750;
    }

    .home-section-description {
        margin: -.75rem 0 1.75rem;
        color: var(--sena-muted);
    }

    .dashboard-grid {
        --bs-gutter-x: 1.25rem;
        --bs-gutter-y: 1.25rem;
    }

    .dashboard-grid > div {
        display: flex;
    }

    .dashboard-card {
        width: 100%;
        overflow: hidden;
        border: 1px solid #e6ece7;
        border-radius: 1rem;
        animation: dashboard-card-in 450ms ease-out both;
        transition: transform 180ms ease, box-shadow 180ms ease, border-color 180ms ease;
    }

    .dashboard-card:hover {
        transform: translateY(-5px);
        border-color: #c9e2bb;
        box-shadow: 0 1rem 2rem rgba(26, 70, 37, .11) !important;
    }

    .dashboard-card .card-body {
        display: flex;
        flex-direction: column;
        align-items: center;
        padding: 1.75rem 1.5rem;
    }

    .dashboard-card .card-title {
        margin: .25rem 0 .6rem;
        color: var(--sena-ink);
        font-size: 1.15rem;
        font-weight: 700;
    }

    .dashboard-card .card-text {
        flex: 1;
        max-width: 260px;
        margin-bottom: 1.25rem;
        color: var(--sena-muted);
        line-height: 1.6;
    }

    .dashboard-card .btn {
        min-width: 150px;
        padding: .65rem 1rem;
        background-color: var(--sena-green);
        border-color: var(--sena-green);
        border-radius: .65rem;
        font-weight: 650;
    }

    .dashboard-card .btn:hover,
    .dashboard-card .btn:focus-visible {
        background-color: var(--sena-dark-green);
        border-color: var(--sena-dark-green);
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

    .sena-carousel {
        overflow: hidden;
        border-radius: 1.25rem;
        box-shadow: 0 1.25rem 2.5rem rgba(18, 48, 28, .14);
    }

    .sena-carousel-image {
        height: clamp(230px, 35vw, 390px);
        object-fit: cover;
    }

    .sena-carousel .carousel-item {
        position: relative;
    }

    .sena-carousel .carousel-item::after {
        position: absolute;
        inset: 35% 0 0;
        background: linear-gradient(transparent, rgba(0, 0, 0, .68));
        content: "";
        pointer-events: none;
    }

    .sena-carousel .carousel-caption {
        z-index: 1;
        right: 8%;
        bottom: 2rem;
        left: 8%;
        text-align: left;
    }

    .sena-carousel .carousel-caption h5 {
        font-size: clamp(1.25rem, 3vw, 2rem);
        font-weight: 750;
    }

    .sena-carousel .carousel-caption p {
        margin-bottom: 0;
        font-size: clamp(.9rem, 1.7vw, 1.05rem);
    }

    .apprentice-welcome {
        padding: clamp(2.5rem, 8vw, 5rem) 1.5rem;
        color: var(--sena-ink);
        text-align: center;
        background: linear-gradient(135deg, #f4faef, #fff);
        border: 1px solid #e3efdc;
        border-radius: 1.5rem;
    }

    .apprentice-welcome h1 {
        margin-bottom: .75rem;
        font-weight: 800;
    }

    .apprentice-welcome p {
        margin-bottom: 0;
        color: var(--sena-muted);
    }

    @media (max-width: 576px) {
        .home-hero { padding-right: 1rem; padding-left: 1rem; }
        .sena-carousel-image { height: 220px; }
        .sena-carousel .carousel-caption { bottom: 1.25rem; }
    }
</style>

<div class="home-page">
@if(auth()->check() && auth()->user()->role === 'aprendiz')
<section class="apprentice-welcome">
    <span class="home-eyebrow">AdminSena · Formación</span>
    <h1 class="mb-4">Bienvenido, aprendiz</h1>
    <p class="lead">Has iniciado sesión como aprendiz del SENA.</p>
</section>
@else
<section class="home-hero">
    <span class="home-eyebrow">Sistema de gestión educativa</span>
    <h1 class="home-title">Bienvenido a <span>AdminSena</span></h1>
    <p class="home-description">Una plataforma para organizar y gestionar los recursos de formación del SENA desde un solo lugar.</p>
</section>

<div id="senaCarousel" class="carousel slide sena-carousel mt-4 mb-5" data-bs-ride="carousel" data-bs-interval="4500" data-bs-pause="hover">
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#senaCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Imagen 1"></button>
        <button type="button" data-bs-target="#senaCarousel" data-bs-slide-to="1" aria-label="Imagen 2"></button>
        <button type="button" data-bs-target="#senaCarousel" data-bs-slide-to="2" aria-label="Imagen 3"></button>
    </div>
    <div class="carousel-inner rounded shadow-sm">
        <div class="carousel-item active">
            <img src="https://images.unsplash.com/photo-1523240795612-9a054b0db644?auto=format&fit=crop&w=1400&q=80" class="d-block w-100 sena-carousel-image" alt="Estudiantes en formación">
            <div class="carousel-caption">
                <h5>Formación para el futuro</h5>
                <p>Educación y oportunidades para todos.</p>
            </div>
        </div>
        <div class="carousel-item">
            <img src="https://images.unsplash.com/photo-1531482615713-2afd69097998?auto=format&fit=crop&w=1400&q=80" class="d-block w-100 sena-carousel-image" alt="Trabajo colaborativo en formación">
            <div class="carousel-caption">
                <h5>Aprendizaje colaborativo</h5>
                <p>Construyendo conocimiento en equipo.</p>
            </div>
        </div>
        <div class="carousel-item">
            <img src="https://images.unsplash.com/photo-1516321318423-f06f85e504b3?auto=format&fit=crop&w=1400&q=80" class="d-block w-100 sena-carousel-image" alt="Tecnología y aprendizaje">
            <div class="carousel-caption">
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


<section class="mt-5" aria-labelledby="management-heading">
    <h2 id="management-heading" class="home-section-heading">Panel de administración</h2>
    <p class="home-section-description">Selecciona un módulo para consultar o gestionar su información.</p>

<div class="row dashboard-grid">

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
</section>
@endif
</div>
@endsection