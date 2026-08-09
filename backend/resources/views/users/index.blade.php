@extends('layouts.app')

@section('title', 'Gestão de Utilizadores')

@section('content')

<div class="container-fluid">

    {{-- ========================================================= --}}
    {{-- MENSAGEM DE SUCESSO --}}
    {{-- ========================================================= --}}

    @if(session('success'))

        <div class="alert alert-success alert-dismissible fade show" role="alert">

            <i class="bi bi-check-circle-fill me-2"></i>

            {{ session('success') }}

            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert"
                aria-label="Fechar alerta">
            </button>

        </div>

    @endif


    {{-- ========================================================= --}}
    {{-- MENSAGEM DE ERRO --}}
    {{-- ========================================================= --}}

    @if(session('error'))

        <div class="alert alert-danger alert-dismissible fade show" role="alert">

            <i class="bi bi-exclamation-triangle-fill me-2"></i>

            {{ session('error') }}

            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert"
                aria-label="Fechar alerta">
            </button>

        </div>

    @endif


    {{-- ========================================================= --}}
    {{-- CABEÇALHO --}}
    {{-- ========================================================= --}}

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>

            <h2 class="fw-bold mb-1">
                Gestão de Utilizadores
            </h2>

            <p class="text-muted mb-0">
                Gerencie todos os utilizadores do Sistema SinTech.
            </p>

        </div>


        {{-- ÚNICO botão Novo Utilizador --}}
        <a
            href="{{ route('users.create') }}"
            class="btn btn-primary">

            <i class="bi bi-person-plus-fill me-1"></i>

            Novo Utilizador

        </a>

    </div>


    {{-- ========================================================= --}}
    {{-- PESQUISA E FILTROS --}}
    {{-- ========================================================= --}}

    <div class="card shadow-sm border-0 mb-4">

        <div class="card-body">

            <form
                action="{{ route('users.index') }}"
                method="GET">

                <div class="row g-3">

                    {{-- Campo de Pesquisa --}}
                    <div class="col-md-5">

                        <label
                            for="pesquisa"
                            class="visually-hidden">

                            Pesquisar por nome, email ou nº crachá

                        </label>

                        <input
                            type="text"
                            id="pesquisa"
                            name="pesquisa"
                            class="form-control"
                            placeholder="Pesquisar por nome, email ou nº crachá..."
                            aria-label="Pesquisar por nome, email ou nº crachá"
                            autocomplete="off"
                            value="{{ $pesquisa ?? '' }}">

                    </div>


                    {{-- Ordenação --}}
                    <div class="col-md-3">

                        <label
                            for="ordem"
                            class="visually-hidden">

                            Ordenar resultados por

                        </label>

                        <select
                            id="ordem"
                            name="ordem"
                            class="form-select"
                            aria-label="Ordenar resultados">

                            <option
                                value="name"
                                {{ ($ordem ?? 'name') == 'name' ? 'selected' : '' }}>

                                Ordenar por Nome

                            </option>

                            <option
                                value="numero_cracha"
                                {{ ($ordem ?? '') == 'numero_cracha' ? 'selected' : '' }}>

                                Ordenar por Nº Crachá

                            </option>

                            <option
                                value="email"
                                {{ ($ordem ?? '') == 'email' ? 'selected' : '' }}>

                                Ordenar por Email

                            </option>

                            <option
                                value="role"
                                {{ ($ordem ?? '') == 'role' ? 'selected' : '' }}>

                                Ordenar por Perfil

                            </option>

                        </select>

                    </div>


                    {{-- Botões --}}
                    <div class="col-md-4 d-flex gap-2">

                        <button
                            type="submit"
                            class="btn btn-primary w-100"
                            aria-label="Pesquisar utilizadores">

                            <i class="bi bi-search me-1"></i>

                            Pesquisar

                        </button>


                        {{-- Limpar pesquisa --}}
                        @if(!empty($pesquisa))

                            <a
                                href="{{ route('users.index') }}"
                                class="btn btn-outline-secondary d-flex align-items-center"
                                title="Limpar pesquisa">

                                <i class="bi bi-x-circle me-1"></i>

                                Limpar

                            </a>

                        @endif

                    </div>

                </div>

            </form>

        </div>

    </div>


    {{-- ========================================================= --}}
    {{-- CONTADOR DE RESULTADOS --}}
    {{-- ========================================================= --}}

    <div class="d-flex justify-content-between align-items-center mb-3">

        <span class="badge bg-white text-dark border px-3 py-2 shadow-sm">

            <i class="bi bi-people-fill text-primary me-1"></i>

            <strong>{{ $users->total() }}</strong>

            utilizador(es) encontrado(s)

        </span>

    </div>


    {{-- ========================================================= --}}
    {{-- TABELA DE UTILIZADORES --}}
    {{-- ========================================================= --}}

    <div class="card shadow-sm border-0">

        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-striped table-hover align-middle mb-0">

                    <thead class="table-dark">

                        <tr>

                            <th scope="col" width="120">
                                Nº Crachá
                            </th>

                            <th scope="col">
                                Nome
                            </th>

                            <th scope="col">
                                Email
                            </th>

                            <th scope="col" width="140">
                                Perfil
                            </th>

                            <th scope="col" width="120">
                                Estado
                            </th>

                            <th scope="col" width="220">
                                Ações
                            </th>

                        </tr>

                    </thead>


                    <tbody>

                    @forelse($users as $user)

                        <tr>

                            {{-- Nº Crachá --}}
                            <td>

                                {{ $user->numero_cracha }}

                            </td>


                            {{-- Nome --}}
                            <td>

                                <div class="fw-semibold">

                                    {{ $user->name }}

                                </div>

                            </td>


                            {{-- Email --}}
                            <td>

                                {{ $user->email }}

                            </td>


                            {{-- Perfil --}}
                            <td>

                                @if($user->role == 'helpdesk')

                                    <span class="badge bg-primary">

                                        HELP DESK

                                    </span>

                                @else

                                    <span class="badge bg-info">

                                        RESPONSÁVEL

                                    </span>

                                @endif

                            </td>


                            {{-- Estado --}}
                            <td>

                                @if($user->ativo)

                                    <span class="badge rounded-pill bg-success">

                                        Ativo

                                    </span>

                                @else

                                    <span class="badge rounded-pill bg-danger">

                                        Inativo

                                    </span>

                                @endif

                            </td>


                            {{-- ================================================= --}}
                            {{-- AÇÕES --}}
                            {{-- ================================================= --}}

                            <td>

                                {{-- Editar --}}
                                <a
                                    href="{{ route('users.edit', $user) }}"
                                    class="btn btn-outline-warning btn-sm"
                                    title="Editar"
                                    aria-label="Editar {{ $user->name }}">

                                    <i class="bi bi-pencil-square"></i>

                                </a>


                                {{-- Não permitir alterar/eliminar o próprio utilizador --}}
                                @if(auth()->id() != $user->id)

                                    {{-- Alternar Estado --}}
                                    <form
                                        action="{{ route('users.toggle-status', $user) }}"
                                        method="POST"
                                        class="d-inline">

                                        @csrf

                                        @method('PATCH')

                                        @if($user->ativo)

                                            <button
                                                type="submit"
                                                class="btn btn-outline-secondary btn-sm"
                                                title="Inativar"
                                                aria-label="Inativar {{ $user->name }}">

                                                <i class="bi bi-person-x-fill"></i>

                                            </button>

                                        @else

                                            <button
                                                type="submit"
                                                class="btn btn-outline-success btn-sm"
                                                title="Ativar"
                                                aria-label="Ativar {{ $user->name }}">

                                                <i class="bi bi-person-check-fill"></i>

                                            </button>

                                        @endif

                                    </form>


                                    {{-- Eliminar --}}
                                    <button
                                        type="button"
                                        class="btn btn-outline-danger btn-sm"
                                        title="Eliminar"
                                        aria-label="Eliminar {{ $user->name }}"
                                        data-bs-toggle="modal"
                                        data-bs-target="#deleteModal"
                                        onclick="setDeleteAction(
                                            '{{ route('users.destroy', $user) }}',
                                            @js($user->name)
                                        )">

                                        <i class="bi bi-trash"></i>

                                    </button>

                                @endif

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td
                                colspan="6"
                                class="text-center text-muted py-4">

                                <i class="bi bi-people fs-2 d-block mb-2"></i>

                                Nenhum utilizador encontrado.

                            </td>

                        </tr>

                    @endforelse

                    </tbody>

                </table>

            </div>


            {{-- ================================================= --}}
            {{-- PAGINAÇÃO --}}
            {{-- ================================================= --}}

            <div class="d-flex justify-content-center mt-4">

                {{ $users->links('pagination::bootstrap-5') }}

            </div>

        </div>

    </div>


    {{-- ========================================================= --}}
    {{-- NAVEGAÇÃO INFERIOR --}}
    {{-- ========================================================= --}}

    <div class="mt-4">

        <a
            href="{{ route('dashboard') }}"
            class="btn btn-secondary">

            <i class="bi bi-arrow-left-circle me-1"></i>

            Voltar ao Dashboard

        </a>

    </div>

</div>


{{-- ========================================================= --}}
{{-- MODAL DE CONFIRMAÇÃO DE ELIMINAÇÃO --}}
{{-- ========================================================= --}}

<div
    class="modal fade"
    id="deleteModal"
    tabindex="-1"
    aria-labelledby="deleteModalLabel"
    aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content border-0 shadow">

            {{-- Cabeçalho --}}
            <div class="modal-header bg-danger text-white">

                <h5
                    class="modal-title fw-bold"
                    id="deleteModalLabel">

                    <i class="bi bi-exclamation-triangle-fill me-2"></i>

                    Confirmar Eliminação

                </h5>

                <button
                    type="button"
                    class="btn-close btn-close-white"
                    data-bs-dismiss="modal"
                    aria-label="Fechar">
                </button>

            </div>


            {{-- Corpo --}}
            <div class="modal-body py-4">

                <p class="mb-0">

                    Tem certeza que pretende eliminar o utilizador

                    <strong
                        id="userNameToDelete"
                        class="text-danger">
                    </strong>?

                </p>


                <div class="alert alert-warning mt-3 mb-0 small">

                    <i class="bi bi-info-circle-fill me-1"></i>

                    Esta ação é irreversível e removerá o registo permanentemente.

                </div>

            </div>


            {{-- Rodapé --}}
            <div class="modal-footer bg-light">

                <button
                    type="button"
                    class="btn btn-secondary"
                    data-bs-dismiss="modal">

                    Cancelar

                </button>


                <form
                    id="deleteForm"
                    method="POST"
                    action="">

                    @csrf

                    @method('DELETE')

                    <button
                        type="submit"
                        class="btn btn-danger">

                        <i class="bi bi-trash me-1"></i>

                        Sim, Eliminar

                    </button>

                </form>

            </div>

        </div>

    </div>

</div>


{{-- ========================================================= --}}
{{-- SCRIPT DO MODAL --}}
{{-- ========================================================= --}}

<script>

    function setDeleteAction(actionUrl, userName) {

        document.getElementById('deleteForm').action = actionUrl;

        document.getElementById('userNameToDelete').textContent = userName;

    }

</script>

@endsection