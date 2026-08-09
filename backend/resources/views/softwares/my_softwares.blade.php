@extends('layouts.app')

@section('title', 'Meus Softwares')

@section('content')

<div class="container-fluid py-3">

    {{-- Cabeçalho --}}
    <div class="card shadow-sm border-0">

        <div class="card-header bg-navy-header py-3 px-4 d-flex justify-content-between align-items-center">

            <div>
                <h4 class="fw-bold mb-0 text-white">
                    <i class="bi bi-hdd-stack me-2"></i>
                    Meus Softwares Instalados
                </h4>

                <small class="text-white-50">
                    Lista de softwares instalados nas suas máquinas
                </small>
            </div>

        </div>


        <div class="card-body p-4">

            {{-- Mensagem de sucesso --}}
            @if(session('success'))

                <div class="alert alert-success alert-dismissible fade show" role="alert">

                    <i class="bi bi-check-circle-fill me-2"></i>

                    {{ session('success') }}

                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="alert">
                    </button>

                </div>

            @endif


            {{-- Barra de Pesquisa --}}
            <form
                method="GET"
                action="{{ route('responsavel.softwares') }}"
                class="mb-4">

                <div class="input-group">

                    <input
                        type="text"
                        name="pesquisa"
                        class="form-control"
                        placeholder="Pesquisar por nome do software..."
                        value="{{ $pesquisa ?? '' }}">

                    <button
                        class="btn btn-navy-submit"
                        type="submit">

                        <i class="bi bi-search me-1"></i>
                        Pesquisar

                    </button>

                </div>

            </form>


            {{-- Tabela --}}
            <div class="table-responsive">

                <table class="table table-hover align-middle">

                    <thead class="table-light">

                        <tr>

                            <th>Software</th>

                            <th>Fabricante</th>

                            <th>Versão</th>

                            <th>Computador</th>

                            <th>Data da Instalação</th>

                            <th>Estado</th>

                        </tr>

                    </thead>


                    <tbody>

                        @forelse($installations as $installation)

                            <tr>

                                {{-- Software --}}
                                <td class="fw-bold">

                                    {{ $installation->software->nome ?? 'N/A' }}

                                </td>


                                {{-- Fabricante --}}
                                <td>

                                    {{ $installation->software->fabricante ?? 'N/A' }}

                                </td>


                                {{-- Versão --}}
                                <td>

                                    <span class="badge bg-secondary">

                                        {{ $installation->software->versao ?? 'N/A' }}

                                    </span>

                                </td>


                                {{-- Computador --}}
                                <td>

                                    @if($installation->computer)

                                        <strong>
                                            {{ $installation->computer->plaqueta }}
                                        </strong>

                                        <br>

                                        <small class="text-muted">

                                            {{ $installation->computer->modelo_cpu }}

                                        </small>

                                    @else

                                        N/A

                                    @endif

                                </td>


                                {{-- Data --}}
                                <td>

                                    {{ $installation->data_instalacao
                                        ? $installation->data_instalacao->format('d/m/Y')
                                        : 'N/A'
                                    }}

                                </td>


                                {{-- Estado --}}
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

                                    @elseif($installation->estado === 'Removido')

                                        <span class="badge bg-danger">

                                            <i class="bi bi-x-circle me-1"></i>
                                            Removido

                                        </span>

                                    @else

                                        <span class="badge bg-secondary">

                                            {{ $installation->estado }}

                                        </span>

                                    @endif

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td
                                    colspan="6"
                                    class="text-center text-muted py-5">

                                    <i class="bi bi-hdd-stack fs-1 d-block mb-3"></i>

                                    <strong>
                                        Nenhum software instalado encontrado.
                                    </strong>

                                    <br>

                                    <small>
                                        Não existem instalações registadas
                                        para as suas máquinas.
                                    </small>

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>


            {{-- Paginação --}}
            @if($installations->hasPages())

                <div class="d-flex justify-content-center mt-4">

                    {{ $installations->links('pagination::bootstrap-5') }}

                </div>

            @endif


            {{-- Voltar --}}
            <div class="mt-4">

                <a
                    href="{{ route('dashboard') }}"
                    class="btn btn-secondary">

                    <i class="bi bi-arrow-left-circle me-1"></i>

                    Voltar ao Dashboard

                </a>

            </div>

        </div>

    </div>

</div>

@endsection