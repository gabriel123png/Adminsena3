<style>
    .admin-navbar {
        --sena-green: #39a900;
        --sena-green-dark: #287d00;
        position: relative;
        z-index: 10;
        padding: .75rem 0;
        background: linear-gradient(110deg, var(--sena-green), #319400);
        box-shadow: 0 4px 16px rgba(27, 77, 16, .16);
    }

    .admin-navbar .container-fluid {
        max-width: 1560px;
    }

    .admin-brand {
        display: inline-flex;
        align-items: center;
        gap: .65rem;
        margin: 0;
        color: #fff;
        font-size: 1.2rem;
        font-weight: 750;
        letter-spacing: -.02em;
    }

    .admin-logo {
        width: 42px;
        height: 42px;
        padding: 3px;
        object-fit: contain;
        background: #fff;
        border: 1px solid rgba(255, 255, 255, .6);
        border-radius: 11px;
    }

    .admin-navbar .navbar-toggler {
        padding: .45rem .6rem;
        border: 1px solid rgba(255, 255, 255, .55);
        border-radius: 10px;
    }

    .admin-navbar .navbar-toggler:focus {
        box-shadow: 0 0 0 .2rem rgba(255, 255, 255, .2);
    }

    .admin-menu {
        align-items: center;
    }

    .admin-nav {
        align-items: center;
        gap: .2rem;
    }

    .admin-navbar .nav-link {
        display: inline-flex;
        align-items: center;
        gap: .45rem;
        padding: .62rem .72rem;
        color: rgba(255, 255, 255, .94);
        font-size: .91rem;
        font-weight: 550;
        white-space: nowrap;
        border-radius: .7rem;
        transition: background-color .18s ease, color .18s ease, transform .18s ease;
    }

    .admin-navbar .nav-link:hover,
    .admin-navbar .nav-link:focus-visible {
        color: #fff;
        background: rgba(18, 69, 0, .22);
        transform: translateY(-1px);
    }

    .admin-navbar .nav-link.active {
        color: var(--sena-green-dark);
        font-weight: 700;
        background: #fff;
        box-shadow: 0 2px 8px rgba(21, 68, 0, .12);
    }

    .admin-nav-icon {
        font-size: 1rem;
        line-height: 1;
    }

    @media (max-width: 1199.98px) {
        .admin-menu {
            margin-top: .85rem;
            padding-top: .7rem;
            border-top: 1px solid rgba(255, 255, 255, .28);
        }

        .admin-nav {
            align-items: stretch;
            gap: .15rem;
        }

        .admin-navbar .nav-link {
            width: 100%;
            padding: .72rem .85rem;
        }
    }

    @media (prefers-reduced-motion: reduce) {
        .admin-navbar .nav-link {
            transition: none;
        }
    }
</style>

<nav class="navbar navbar-expand-xl navbar-dark admin-navbar">
    <div class="container-fluid px-3 px-lg-4">
        <a class="navbar-brand admin-brand" href="{{ route('home') }}">
            <img
                src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSAM-jtaxKYljPzx7-TEn-u8MQWRjFmSUTMIrZAYLFB4ZfIHjBOlRQPlGA&s=10"
                alt="Logo SENA"
                class="admin-logo">
            <span>AdminSena</span>
        </a>

        <button
            class="navbar-toggler"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#adminNavbar"
            aria-controls="adminNavbar"
            aria-expanded="false"
            aria-label="Abrir o cerrar menú">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse admin-menu" id="adminNavbar">
            @php
                $navigationItems = [
                    ['label' => 'Inicio', 'icon' => '🏠', 'route' => 'home', 'active' => 'home'],
                    ['label' => 'Áreas', 'icon' => '📁', 'route' => 'areas.index', 'active' => 'areas.*'],
                    ['label' => 'Centros', 'icon' => '🏢', 'route' => 'training_centers.index', 'active' => 'training_centers.*'],
                    ['label' => 'Computadores', 'icon' => '💻', 'route' => 'computers.index', 'active' => 'computers.*'],
                    ['label' => 'Cursos', 'icon' => '📚', 'route' => 'courses.index', 'active' => 'courses.*'],
                    ['label' => 'Instructores', 'icon' => '👨‍🏫', 'route' => 'teachers.index', 'active' => 'teachers.*'],
                    ['label' => 'Aprendices', 'icon' => '🎓', 'route' => 'apprentices.index', 'active' => 'apprentices.*'],
                ];

                if (auth()->check() && auth()->user()->role === 'aprendiz') {
                    $navigationItems = [
                        ['label' => 'Mi panel', 'icon' => '🎓', 'route' => 'apprentice.dashboard', 'active' => 'apprentice.dashboard'],
                    ];
                }
            @endphp

            <ul class="navbar-nav admin-nav ms-auto">
                @foreach($navigationItems as $item)
                    <li class="nav-item">
                        <a
                            class="nav-link {{ request()->routeIs($item['active']) ? 'active' : '' }}"
                            href="{{ route($item['route']) }}"
                            @if(request()->routeIs($item['active'])) aria-current="page" @endif>
                            <span class="admin-nav-icon" aria-hidden="true">{{ $item['icon'] }}</span>
                            <span>{{ $item['label'] }}</span>
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</nav>
