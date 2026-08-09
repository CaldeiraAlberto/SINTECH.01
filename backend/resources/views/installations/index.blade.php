@extends('layouts.app')

@section('title', 'Gestão de Instalações')

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
            Gestão de Instalações
        </h2>

        <p class="text-muted mb-0">
            Gerencie todas as instalações de software realizadas.
        </p>
    </div>

    {{-- ÚNICO botão Nova Instalação --}}
    <a
        href="{{ route('installations.create') }}"
        class="btn btn-primary">

        <i class="bi bi-plus-circle-fill me-1"></i>

        Nova Instalação
    </a>

</div>


{{-- ========================================================= --}}
{{-- PESQUISA --}}
{{-- ========================================================= --}}

<div class="card shadow-sm border-0 mb-3">

    <div class="card-body">

        <form
            action="{{ route('installations.index') }}"
            method="GET">

            <div class="row g-3">

                <div class="col-md-9">

                    <input
                        type="text"
                        name="pesquisa"
                        class="form-control"
                        placeholder="Pesquisar por computador, responsável, software, estado ou técnico..."
                        value="{{ $pesquisa ?? '' }}">

                </div>

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
{{-- TABELA --}}
{{-- ========================================================= --}}

<div class="card shadow-sm border-0">

    <div class="card-body">

        <div class="table-responsive">

            <table class="table table-hover table-striped align-middle">

                <thead class="table-dark">

                    <tr>

                        <th>Computador</th>

                        <th>Responsável</th>

                        <th>Software</th>

                        <th>Data</th>

                        <th>Instalado por</th>

                        <th>Estado</th>

                        <th width="170">Ações</th>

                    </tr>

                </thead>

                <tbody>

                @forelse($installations as $installation)

                    <tr>

                        {{-- ================================================= --}}
                        {{-- COMPUTADOR --}}
                        {{-- ================================================= --}}

                        <td>

                            @if($installation->computer)

                                <div class="fw-semibold">
                                    {{ $installation->computer->plaqueta }}
                                </div>

                                <small class="text-muted">
                                    {{ $installation->computer->modelo_cpu }}
                                </small>

                            @else

                                <span class="text-muted">
                                    Computador não encontrado
                                </span>

                            @endif

                        </td>


                        {{-- ================================================= --}}
                        {{-- RESPONSÁVEL --}}
                        {{-- ================================================= --}}

                        <td>

                            @if($installation->responsavel)

                                <div class="fw-semibold">

                                    <i class="bi bi-person-fill me-1"></i>

                                    {{ $installation->responsavel->name }}

                                </div>

                                <small class="text-muted">

                                    {{ $installation->responsavel->numero_cracha }}

                                </small>

                            @else

                                <span class="text-muted">
                                    Não definido
                                </span>

                            @endif

                        </td>


                        {{-- ================================================= --}}
                        {{-- SOFTWARE --}}
                        {{-- ================================================= --}}

                        <td>

                            @if($installation->software)

                                <div class="fw-semibold">
                                    {{ $installation->software->nome }}
                                </div>

                                @if($installation->software->versao)
                                    <small class="text-muted">
                                        Versão {{ $installation->software->versao }}
                                    </small>
                                @endif

                            @else

                                <span class="text-muted">
                                    Software não encontrado
                                </span>

                            @endif

                        </td>


                        {{-- ================================================= --}}
                        {{-- DATA --}}
                        {{-- ================================================= --}}

                        <td>

                            {{ $installation->data_instalacao?->format('d/m/Y') }}

                        </td>


                        {{-- ================================================= --}}
                        {{-- INSTALADO POR --}}
                        {{-- ================================================= --}}

                        <td>

                            {{ $installation->instalado_por }}

                        </td>


                        {{-- ================================================= --}}
                        {{-- ESTADO --}}
                        {{-- ================================================= --}}

                        <td>

                            @if($installation->estado === 'Instalado')

                                <span class="badge bg-success">
                                    <i class="bi bi-check-circle me-1"></i>
                                    Instalado
                                </span>

                            @elseif($installation->estado === 'Atualizado')

                                <span class="badge bg-warning text-dark">
                                    <i class="bi bi-arrow-repeat me-1"></i>
                                    Atualizado
                                </span>

                            @else

                                <span class="badge bg-danger">
                                    <i class="bi bi-x-circle me-1"></i>
                                    Removido
                                </span>

                            @endif

                        </td>


                        {{-- ================================================= --}}
                        {{-- AÇÕES --}}
                        {{-- ================================================= --}}

                        <td>

                            {{-- Editar --}}
                            <a
                                href="{{ route('installations.edit', $installation->id) }}"
                                class="btn btn-outline-warning btn-sm"
                                title="Editar">

                                <i class="bi bi-pencil-square"></i>

                            </a>


                            {{-- Eliminar --}}
                            <form
                                action="{{ route('installations.destroy', $installation->id) }}"
                                method="POST"
                                class="d-inline">

                                @csrf

                                @method('DELETE')

                                <button
                                    type="submit"
                                    class="btn btn-outline-danger btn-sm"
                                    onclick="return confirm('Pretende eliminar esta instalação?')"
                                    title="Eliminar">

                                    <i class="bi bi-trash"></i>

                                </button>

                            </form>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td
                            colspan="7"
                            class="text-center py-4 text-muted">

                            <i class="bi bi-pc-display fs-2 d-block mb-2"></i>

                            Nenhuma instalação registada.

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

            {{ $installations->links('pagination::bootstrap-5') }}

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