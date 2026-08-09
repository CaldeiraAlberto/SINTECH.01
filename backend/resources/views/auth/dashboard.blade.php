<!DOCTYPE html>
<html lang="pt">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Dashboard - SinTech</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-dark bg-primary">

    <div class="container">

        <a class="navbar-brand" href="#">

            SinTech

        </a>

        <div class="ms-auto">

            <form action="{{ route('logout') }}" method="POST">

                @csrf

                <button class="btn btn-light">

                    Sair

                </button>

            </form>

        </div>

    </div>

</nav>

<div class="container mt-5">

    <div class="card shadow">

        <div class="card-body">

            <h2>

                Bem-vindo ao SinTech

            </h2>

            <hr>

            <p>

                <strong>Nome:</strong>

                {{ Auth::user()->name }}

            </p>

            <p>

                <strong>Número do Crachá:</strong>

                {{ Auth::user()->numero_cracha }}

            </p>

            <p>

                <strong>Email:</strong>

                {{ Auth::user()->email }}

            </p>

            <p>

                <strong>Perfil:</strong>

                {{ strtoupper(Auth::user()->role) }}

            </p>

            <p>

                <strong>Estado:</strong>

                @if(Auth::user()->ativo)

                    <span class="badge bg-success">

                        Ativo

                    </span>

                @else

                    <span class="badge bg-danger">

                        Inativo

                    </span>

                @endif

            </p>

        </div>

    </div>

</div>

</body>

</html>