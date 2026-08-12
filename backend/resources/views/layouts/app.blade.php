<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'SinTech')</title>

    @vite([
        'resources/css/app.css',
        'resources/js/app.js'
    ])

    <style>
        .sidebar-hidden {
            display: none !important;
        }
    </style>
</head>

<body class="bg-light">

    {{-- Barra Superior --}}
    @include('components.navbar')

    <div class="container-fluid p-0">
        <div class="row g-0">

            {{-- Menu Lateral --}}
            @include('components.sidebar')

            {{-- Conteúdo Principal (usa 'col' para expandir automaticamente) --}}
            <main id="main-content" class="col p-4">

                @yield('content')

            </main>

        </div>
    </div>

    {{-- Rodapé --}}
    @include('components.footer')

    {{-- Script de Alternância da Sidebar --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const toggleBtn = document.getElementById('sidebarToggle');
            const sidebar = document.getElementById('sidebar');

            if (toggleBtn && sidebar) {
                toggleBtn.addEventListener('click', function () {
                    sidebar.classList.toggle('sidebar-hidden');
                });
            }
        });
    </script>

</body>

</html>