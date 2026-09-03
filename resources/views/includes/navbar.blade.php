<style>
    :root {
        --sena-green: #39A900;
        --sena-dark: #1f1f1f;
        --sena-hover: #2f8d00;
    }

    .admin-navbar {
        background-color: var(--sena-green) !important;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.12);
    }

    .admin-logo {
        width: 42px;
        height: 42px;
        object-fit: contain;
        background: white;
        border-radius: 6px;
        padding: 3px;
    }

    .admin-brand {
        font-size: 1.2rem;
        font-weight: 700;
        color: white !important;
        letter-spacing: .3px;
    }

    .admin-navbar .nav-link {
        color: rgba(255, 255, 255, .95) !important;
        padding: 10px 14px !important;
        border-radius: 6px;
        margin: 2px;
        transition: .2s ease;
    }

    .admin-navbar .nav-link:hover {
        background-color: rgba(0, 0, 0, .15);
        color: white !important;
    }

    /* Botón hamburguesa */
    .admin-toggler {
        border: 1px solid rgba(255, 255, 255, .6) !important;
        padding: 7px 10px;
        border-radius: 6px;
    }

    .admin-toggler:focus {
        box-shadow: none !important;
    }

    /* Menú móvil */
    @media (max-width: 991.98px) {

        .admin-menu {
            margin-top: 10px;
            padding: 10px;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 5px 18px rgba(0, 0, 0, .18);
        }

        .admin-menu .nav-link {
            color: #333 !important;
            padding: 12px 14px !important;
            margin: 2px 0;
            border-radius: 7px;
        }

        .admin-menu .nav-link:hover {
            background-color: #f1f1f1;
            color: var(--sena-green) !important;
        }
    }
</style>

<nav class="navbar navbar-expand-lg navbar-dark admin-navbar">


<div class="container-fluid px-3 px-lg-4">

    {{-- LOGO --}}
    <a class="navbar-brand d-flex align-items-center"
       href="{{ route('home') }}">

        <img
            src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSAM-jtaxKYljPzx7-TEn-u8MQWRjFmSUTMIrZAYLFB4ZfIHjBOlRQPlGA&s=10"
            alt="Logo SENA"
            class="admin-logo me-2">

        <span class="admin-brand">
            AdminSena
        </span>

    </a>


    {{-- HAMBURGUESA --}}
    <button
        class="navbar-toggler admin-toggler"
        type="button"
        data-bs-toggle="collapse"
        data-bs-target="#adminNavbar"
        aria-controls="adminNavbar"
        aria-expanded="false"
        aria-label="Abrir menú">

        <span class="navbar-toggler-icon"></span>

    </button>


    {{-- MENÚ --}}
    <div
        class="collapse navbar-collapse admin-menu"
        id="adminNavbar">

        <ul class="navbar-nav me-auto mb-2 mb-lg-0">


            {{-- INICIO --}}
            <li class="nav-item">

                <a
                    class="nav-link"
                    href="{{ route('home') }}">

                    🏠 Inicio

                </a>

            </li>


            {{-- ÁREAS --}}
            <li class="nav-item">

                <a
                    class="nav-link"
                    href="{{ route('areas.index') }}">

                    📁 Áreas

                </a>

            </li>


            {{-- CENTROS --}}
            <li class="nav-item">

                <a
                    class="nav-link"
                    href="{{ route('training_centers.create') }}">

                    🏢 Centros de formación

                </a>

            </li>


            {{-- COMPUTADORES --}}
            <li class="nav-item">

                <a
                    class="nav-link"
                    href="{{ route('computers.create') }}">

                    💻 Computadores

                </a>

            </li>


            {{-- CURSOS --}}
            <li class="nav-item">

                <a
                    class="nav-link"
                    href="{{ route('courses.index') }}">

                    📚 Cursos

                </a>

            </li>


            {{-- INSTRUCTORES --}}
            <li class="nav-item">

                <a
                    class="nav-link"
                    href="{{ route('teachers.index') }}">

                    👨‍🏫 Instructores

                </a>

            </li>


        </ul>


        {{-- USUARIO --}}
        @auth

            <div class="dropdown">

                <button
                    class="btn btn-light dropdown-toggle"
                    type="button"
                    data-bs-toggle="dropdown"
                    aria-expanded="false">

                    {{ auth()->user()->name }}

                </button>

                <ul class="dropdown-menu dropdown-menu-end">

                    <li>

                        <a
                            class="dropdown-item"
                            href="{{ route('carnet.index') }}">

                            Mi perfil

                        </a>

                    </li>

                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <li>

                        <form
                            action="{{ route('logout') }}"
                            method="POST">

                            @csrf

                            <button
                                type="submit"
                                class="dropdown-item text-danger">

                                Cerrar sesión

                            </button>

                        </form>

                    </li>

                </ul>

            </div>

        @endauth

    </div>

</div>
</nav>
