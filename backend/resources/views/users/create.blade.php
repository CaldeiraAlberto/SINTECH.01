<!DOCTYPE html>
<html lang="pt">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Novo Utilizador</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

<div class="container mt-5">

    <div class="card shadow">

        <div class="card-header bg-primary text-white">

            <h3>Novo Utilizador</h3>

        </div>

        <div class="card-body">

            @if ($errors->any())

                <div class="alert alert-danger">

                    <ul>

                        @foreach ($errors->all() as $error)

                            <li>{{ $error }}</li>

                        @endforeach

                    </ul>

                </div>

            @endif

            <form action="{{ route('users.store') }}" method="POST">

                @csrf

                <div class="mb-3">

                    <label class="form-label">Nº Crachá</label>

                    <input
                        type="text"
                        name="numero_cracha"
                        class="form-control"
                        value="{{ old('numero_cracha') }}"
                        required>

                </div>

                <div class="mb-3">

                    <label class="form-label">Nome</label>

                    <input
                        type="text"
                        name="name"
                        class="form-control"
                        value="{{ old('name') }}"
                        required>

                </div>

                <div class="mb-3">

                    <label class="form-label">Email</label>

                    <input
                        type="email"
                        name="email"
                        class="form-control"
                        value="{{ old('email') }}"
                        required>

                </div>

                <div class="mb-3">

                    <label class="form-label">Palavra-passe</label>

                    <input
                        type="password"
                        name="password"
                        class="form-control"
                        required>

                </div>

                <div class="mb-3">

                    <label class="form-label">Perfil</label>

                    <select
                        name="role"
                        class="form-select">

                        <option value="helpdesk">Help Desk</option>

                        <option value="responsavel">Responsável</option>

                    </select>

                </div>

                <button
                    type="submit"
                    class="btn btn-success">

                    Guardar

                </button>

                <a
                    href="{{ route('users.index') }}"
                    class="btn btn-secondary">

                    Cancelar

                </a>

            </form>

        </div>

    </div>

</div>

</body>

</html>