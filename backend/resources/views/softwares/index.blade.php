@extends('layouts.app')

@section('title', 'Gestão de Softwares')

@section('content')

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
            aria-label="Close">
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
            aria-label="Close">
        </button>

    </div>

@endif


{{-- ========================================================= --}}
{{-- CABEÇALHO --}}
{{-- ========================================================= --}}

<div class="d-flex justify-content-between align-items-center mb-3">

    <div>

        <h2 class="fw-bold mb-1">
            Gestão de Softwares
        </h2>

        <p class="text-muted mb-0">
            Gerencie todos os softwares registrados no SinTech.
        </p>

    </div>


    {{-- ÚNICO botão Novo Software --}}
    <a
        href="{{ route('softwares.create') }}"
        class="btn btn-primary">

        <i class="bi bi-plus-circle-fill me-1"></i>

        Novo Software

    </a>

</div>


{{-- ========================================================= --}}
{{-- PESQUISA E ORDENAÇÃO --}}
{{-- ========================================================= --}}

<div class="card shadow-sm border-0 mb-3">

    <div class="card-body">

        <form
            action="{{ route('softwares.index') }}"
            method="GET">

            <div class="row g-3">

                {{-- Campo de pesquisa --}}
                <div class="col-md-6">

                    <input
                        type="text"
                        name="pesquisa"
                        class="form-control"
                        placeholder="Pesquisar por nome, versão, fabricante, tipo ou estado..."
                        value="{{ $pesquisa ?? '' }}">

                </div>


                {{-- Ordenação --}}
                <div class="col-md-3">

                    <select
                        name="ordem"
                        class="form-select">

                        <option
                            value="nome"
                            {{ ($ordem ?? 'nome') == 'nome' ? 'selected' : '' }}>

                            Ordenar por Nome

                        </option>

                        <option
                            value="versao"
                            {{ ($ordem ?? '') == 'versao' ? 'selected' : '' }}>

                            Ordenar por Versão

                        </option>

                        <option
                            value="fabricante"
                            {{ ($ordem ?? '') == 'fabricante' ? 'selected' : '' }}>

                            Ordenar por Fabricante

                        </option>

                        <option
                            value="tipo"
                            {{ ($ordem ?? '') == 'tipo' ? 'selected' : '' }}>

                            Ordenar por Tipo

                        </option>

                        <option
                            value="estado"
                            {{ ($ordem ?? '') == 'estado' ? 'selected' : '' }}>

                            Ordenar por Estado

                        </option>

                    </select>

                </div>


                {{-- Botão pesquisar --}}
                <div class="col-md-3 d-grid">

                    <button
                        type="submit"
                        class="btn btn-primary">

                        <i class="bi bi-search me-1"></i>

                        Pesquisar

                    </button>

                </div>

            </div>

        </form>

    </div>

</div>


{{-- ========================================================= --}}
{{-- TABELA DE SOFTWARES --}}
{{-- ========================================================= --}}

<div class="card shadow-sm border-0">

    <div class="card-body">

        <div class="table-responsive">

            <table class="table table-hover table-striped align-middle">

                <thead class="table-dark">

                    <tr>

                        <th>Nome</th>

                        <th>Versão</th>

                        <th>Fabricante</th>

                        <th>Tipo</th>

                        <th>Estado</th>

                        <th width="170">Ações</th>

                    </tr>

                </thead>


                <tbody>

                @forelse($softwares as $software)

                    <tr>

                        {{-- ================================================= --}}
                        {{-- NOME --}}
                        {{-- ================================================= --}}

                        <td>

                            <div class="fw-semibold">

                                {{ $software->nome }}

                            </div>

                        </td>


                        {{-- ================================================= --}}
                        {{-- VERSÃO --}}
                        {{-- ================================================= --}}

                        <td>

                            {{ $software->versao }}

                        </td>


                        {{-- ================================================= --}}
                        {{-- FABRICANTE --}}
                        {{-- ================================================= --}}

                        <td>

                            {{ $software->fabricante }}

                        </td>


                        {{-- ================================================= --}}
                        {{-- TIPO --}}
                        {{-- ================================================= --}}

                        <td>

                            <span class="badge bg-secondary">

                                {{ $software->tipo }}

                            </span>

                        </td>


                        {{-- ================================================= --}}
                        {{-- ESTADO --}}
                        {{-- ================================================= --}}

                        <td>

                            @if($software->estado === 'Ativo')

                                <span class="badge bg-success">

                                    <i class="bi bi-check-circle me-1"></i>

                                    Ativo

                                </span>

                            @elseif($software->estado === 'Expirado')

                                <span class="badge bg-warning text-dark">

                                    <i class="bi bi-exclamation-circle me-1"></i>

                                    Expirado

                                </span>

                            @else

                                <span class="badge bg-danger">

                                    <i class="bi bi-x-circle me-1"></i>

                                    Descontinuado

                                </span>

                            @endif

                        </td>


                        {{-- ================================================= --}}
                        {{-- AÇÕES --}}
                        {{-- ================================================= --}}

                        <td>

                            {{-- Editar --}}
                            <a
                                href="{{ route('softwares.edit', $software->id) }}"
                                class="btn btn-outline-warning btn-sm"
                                title="Editar">

                                <i class="bi bi-pencil-square"></i>

                            </a>


                            {{-- Eliminar --}}
                            <form
                                action="{{ route('softwares.destroy', $software->id) }}"
                                method="POST"
                                class="d-inline">

                                @csrf

                                @method('DELETE')

                                <button
                                    type="submit"
                                    class="btn btn-outline-danger btn-sm"
                                    onclick="return confirm('Pretende eliminar este software?')"
                                    title="Eliminar">

                                    <i class="bi bi-trash"></i>

                                </button>

                            </form>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td
                            colspan="6"
                            class="text-center py-4 text-muted">

                            <i class="bi bi-hdd-stack fs-2 d-block mb-2"></i>

                            Nenhum software registrado.

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

            {{ $softwares->links('pagination::bootstrap-5') }}

        </div>

    </div>

</div>


{{-- ========================================================= --}}
{{-- NAVEGAÇÃO INFERIOR --}}
{{-- ========================================================= --}}

<div class="mt-3">

    <a
        href="{{ route('dashboard') }}"
        class="btn btn-secondary">

        <i class="bi bi-arrow-left-circle me-1"></i>

        Voltar ao Dashboard

    </a>

</div>

@endsection