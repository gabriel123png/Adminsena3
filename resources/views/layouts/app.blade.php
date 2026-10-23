<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        @yield('title', 'AdminSena')
    </title>

    <!-- Bootstrap -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet">

    <style>
        :root {
            color-scheme: light;
            --page-accent: #39a900;
            --page-accent-soft: #e9f6e2;
            --page-ink: #1c3025;
            --page-muted: #6c7b71;
            --page-line: #e5ece7;
            --page-shadow: 0 12px 30px rgba(32, 61, 41, .07);
        }

        .theme-training_centers {
            --page-accent: #168b72;
            --page-accent-soft: #e2f5f0;
        }

        .theme-computers {
            --page-accent: #3974c6;
            --page-accent-soft: #e8f0fc;
        }

        .theme-courses {
            --page-accent: #8054b8;
            --page-accent-soft: #f0eafb;
        }

        .theme-teachers {
            --page-accent: #d07928;
            --page-accent-soft: #fbefdf;
        }

        .theme-apprentices,
        .theme-aprendiz {
            --page-accent: #cf5d78;
            --page-accent-soft: #faeaf0;
        }

        body.admin-app {
            min-height: 100vh;
            color: var(--page-ink);
            background:
                radial-gradient(ellipse at 85% 5%, var(--page-accent-soft), transparent 28rem),
                #f7f9f7;
        }

        .admin-main {
            min-height: calc(100vh - 230px);
            padding-top: clamp(1.5rem, 4vw, 3rem);
            padding-bottom: 3.5rem;
            animation: page-appear .4s ease-out both;
        }

        @keyframes page-appear {
            from { opacity: 0; transform: translateY(8px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .admin-main h1,
        .admin-main h2 {
            color: var(--page-ink);
            font-weight: 750;
            letter-spacing: -.035em;
        }

        .admin-main h1:not(.home-title) {
            font-size: clamp(1.7rem, 3vw, 2.35rem);
        }

        .admin-main .card {
            overflow: hidden;
            border: 1px solid var(--page-line);
            border-radius: 1rem;
            box-shadow: var(--page-shadow);
        }

        .admin-main .card-header {
            padding: 1.15rem 1.4rem;
            background: linear-gradient(110deg, var(--page-accent-soft), #fff);
            border-bottom: 1px solid var(--page-line);
        }

        .admin-main .card-header h1,
        .admin-main .card-header h2 {
            margin: 0;
        }

        .admin-main .card-body {
            padding: clamp(1.1rem, 3vw, 1.7rem);
        }

        .admin-main .btn {
            border-radius: .68rem;
            font-weight: 600;
            transition: transform .16s ease, box-shadow .16s ease, background-color .16s ease;
        }

        .admin-main .btn:hover {
            transform: translateY(-1px);
            box-shadow: 0 5px 12px rgba(27, 54, 35, .12);
        }

        .admin-main .btn-success {
            background: var(--page-accent);
            border-color: var(--page-accent);
        }

        .admin-main .btn-success:hover,
        .admin-main .btn-success:focus {
            background: color-mix(in srgb, var(--page-accent) 86%, #000);
            border-color: color-mix(in srgb, var(--page-accent) 86%, #000);
        }

        .admin-main .form-label {
            color: var(--page-ink);
            font-size: .92rem;
            font-weight: 650;
        }

        .admin-main .form-control,
        .admin-main .form-select {
            min-height: 44px;
            border-color: #dce5de;
            border-radius: .68rem;
        }

        .admin-main textarea.form-control {
            min-height: auto;
        }

        .admin-main .form-control:focus,
        .admin-main .form-select:focus {
            border-color: var(--page-accent);
            box-shadow: 0 0 0 .22rem color-mix(in srgb, var(--page-accent) 18%, transparent);
        }

        .table-toolbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
            margin-bottom: 1rem;
        }

        .table-toolbar-label {
            color: var(--page-muted);
            font-size: .88rem;
            font-weight: 600;
        }

        .table-search {
            width: min(100%, 320px);
        }

        .admin-main .table-responsive {
            border: 1px solid var(--page-line);
            border-radius: .8rem;
        }

        .admin-main .table {
            margin-bottom: 0;
            vertical-align: middle;
        }

        .admin-main .table thead th {
            padding: .9rem 1rem;
            color: #52665a;
            font-size: .76rem;
            font-weight: 750;
            letter-spacing: .055em;
            text-transform: uppercase;
            white-space: nowrap;
            background: var(--page-accent-soft);
            border-bottom: 1px solid var(--page-line);
        }

        .admin-main .table tbody td {
            padding: .85rem 1rem;
            border-color: #edf1ee;
        }

        .admin-main .table tbody tr {
            transition: background-color .15s ease;
        }

        .admin-main .table tbody tr:hover {
            background: color-mix(in srgb, var(--page-accent-soft) 55%, white);
        }

        .table-filter-empty {
            padding: 1.25rem;
            color: var(--page-muted);
            text-align: center;
        }

        .admin-main .alert {
            border: 0;
            border-radius: .8rem;
            box-shadow: 0 5px 16px rgba(32, 61, 41, .06);
        }

        .admin-footer {
            color: rgba(255, 255, 255, .82);
            background: linear-gradient(115deg, #14291c, #203c2a);
        }

        .admin-footer h5 {
            margin-bottom: .85rem;
            color: #fff;
            font-size: 1rem;
            font-weight: 700;
        }

        .admin-footer a {
            display: inline-block;
            padding: .2rem 0;
            color: rgba(255, 255, 255, .78) !important;
            transition: color .16s ease, transform .16s ease;
        }

        .admin-footer a:hover {
            color: #a9e78b !important;
            transform: translateX(3px);
        }

        @media (max-width: 575.98px) {
            .admin-main {
                padding-top: 1.25rem;
            }

            .admin-main .d-flex.justify-content-between {
                align-items: flex-start !important;
                gap: .85rem;
            }

            .table-toolbar {
                align-items: stretch;
                flex-direction: column;
            }

            .table-search {
                width: 100%;
            }
        }

        @media (prefers-reduced-motion: reduce) {
            .admin-main,
            .admin-main .btn,
            .admin-main .table tbody tr {
                animation: none;
                transition: none;
            }
        }
    </style>

</head>

<body class="admin-app theme-{{ request()->segment(1) ?: 'home' }}">

    <!-- Navbar -->
    @include('includes.navbar')


    <!-- Contenido de cada página -->
    <main class="container admin-main">

        @yield('content')

    </main>


    <!-- Footer -->
    @include('includes.footer')


    <!-- Bootstrap JavaScript -->
    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js">
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            document.querySelectorAll('.admin-main table').forEach((table) => {
                const rows = Array.from(table.tBodies).flatMap((body) => Array.from(body.rows))
                    .filter((row) => !row.querySelector('td[colspan]'));

                if (rows.length === 0) {
                    return;
                }

                const toolbar = document.createElement('div');
                toolbar.className = 'table-toolbar';

                const count = document.createElement('span');
                count.className = 'table-toolbar-label';
                count.textContent = `${rows.length} ${rows.length === 1 ? 'registro' : 'registros'}`;

                const search = document.createElement('input');
                search.type = 'search';
                search.className = 'form-control table-search';
                search.placeholder = 'Buscar en la tabla...';
                search.setAttribute('aria-label', 'Buscar registros en la tabla');

                const responsiveWrapper = document.createElement('div');
                responsiveWrapper.className = 'table-responsive';
                table.parentElement.insertBefore(responsiveWrapper, table);
                responsiveWrapper.append(table);

                toolbar.append(count, search);
                table.parentElement.insertBefore(toolbar, responsiveWrapper);

                const emptyMessage = document.createElement('p');
                emptyMessage.className = 'table-filter-empty d-none';
                emptyMessage.textContent = 'No se encontraron resultados para la búsqueda.';
                responsiveWrapper.after(emptyMessage);

                search.addEventListener('input', () => {
                    const query = search.value.trim().toLocaleLowerCase();
                    let visible = 0;

                    rows.forEach((row) => {
                        const matches = row.textContent.toLocaleLowerCase().includes(query);
                        row.hidden = !matches;
                        visible += matches ? 1 : 0;
                    });

                    count.textContent = `${visible} ${visible === 1 ? 'registro' : 'registros'}`;
                    emptyMessage.classList.toggle('d-none', visible !== 0);
                });
            });
        });
    </script>

</body>

</html>