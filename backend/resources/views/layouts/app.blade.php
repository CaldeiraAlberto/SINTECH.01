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
</head>

<body class="bg-light">

    {{-- Barra Superior --}}
    @include('components.navbar')

    <div class="container-fluid p-0">
        <div class="row g-0">

            {{-- Menu Lateral --}}
            @include('components.sidebar')

            {{-- Conteúdo Principal --}}
            <main class="col-md-10 p-4">

                @yield('content')

            </main>

        </div>
    </div>

    {{-- Rodapé --}}
    @include('components.footer')

</body>

</html>