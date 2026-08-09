@extends('layouts.app')

@section('title', 'Editar Utilizador')

@section('content')

<div class="container">

    <div class="row justify-content-center">

        <div class="col-lg-8">

            <div class="card shadow">

                <div class="card-header bg-warning">

                    <h3 class="mb-0">

                        Editar Utilizador

                    </h3>

                </div>

                <div class="card-body">

                    @if ($errors->any())

                        <div class="alert alert-danger">

                            <ul class="mb-0">

                                @foreach ($errors->all() as $error)

                                    <li>{{ $error }}</li>

                                @endforeach

                            </ul>

                        </div>

                    @endif

                    <form action="{{ route('users.update', $user) }}" method="POST">

                        @csrf

                        @method('PUT')

                        <div class="mb-3">

                            <label class="form-label">

                                Nº Crachá

                            </label>

                            <input
                                type="text"
                                name="numero_cracha"
                                class="form-control"
                                value="{{ old('numero_cracha', $user->numero_cracha) }}"
                                required>

                        </div>

                        <div class="mb-3">

                            <label class="form-label">

                                Nome

                            </label>

                            <input
                                type="text"
                                name="name"
                                class="form-control"
                                value="{{ old('name', $user->name) }}"
                                required>

                        </div>

                        <div class="mb-3">

                            <label class="form-label">

                                Email

                            </label>

                            <input
                                type="email"
                                name="email"
                                class="form-control"
                                value="{{ old('email', $user->email) }}"
                                required>

                        </div>

                        <div class="mb-3">

                            <label class="form-label">

                                Palavra-passe

                            </label>

                            <input
                                type="password"
                                name="password"
                                class="form-control">

                            <small class="text-muted">

                                Deixe em branco para manter a palavra-passe atual.

                            </small>

                        </div>

                        <div class="mb-3">

                            <label class="form-label">

                                Perfil

                            </label>

                            <select
                                name="role"
                                class="form-select">

                                <option value="helpdesk"
                                    {{ old('role', $user->role) == 'helpdesk' ? 'selected' : '' }}>

                                    Help Desk

                                </option>

                                <option value="responsavel"
                                    {{ old('role', $user->role) == 'responsavel' ? 'selected' : '' }}>

                                    Responsável

                                </option>

                            </select>

                        </div>

                        <div class="mb-3">

                            <label class="form-label">

                                Estado

                            </label>

                            <select
                                name="ativo"
                                class="form-select">

                                <option value="1"
                                    {{ old('ativo', $user->ativo) ? 'selected' : '' }}>

                                    Ativo

                                </option>

                                <option value="0"
                                    {{ !old('ativo', $user->ativo) ? 'selected' : '' }}>

                                    Inativo

                                </option>

                            </select>

                        </div>

                        <button
                            type="submit"
                            class="btn btn-warning">

                            Atualizar

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

    </div>

</div>

@endsection