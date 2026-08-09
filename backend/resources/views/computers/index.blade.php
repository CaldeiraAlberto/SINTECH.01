@extends('layouts.app')
@section('title', 'Gestão de Computadores')
@section('content')
<style>
    /* ==========================================================
       CARTÕES
       ========================================================== */
    .card-modern {
        border-radius: 1rem !important;
        overflow: hidden;
    }
    /* ==========================================================
       CABEÇALHO AZUL
       ========================================================== */
    .bg-navy-header {
        background-color: #0f2547 !important;
        color: #ffffff !important;
    }
    /* ==========================================================
       BOTÃO PRINCIPAL
       ========================================================== */
    .btn-navy {
        background-color: #0f2547;
        color: #ffffff;
        border: none;
        border-radius: 0.65rem;
        padding: 0.6rem 1.25rem;
        font-weight: 600;
        transition: all 0.2s ease;
    }
    .btn-navy:hover {
        background-color: #163869;
        color: #ffffff;
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(15, 37, 71, 0.2);
    }
    /* ==========================================================
       CAMPOS DE PESQUISA
       ========================================================== */
    .form-control-modern,
    .form-select-modern {
        border-radius: 0.65rem;
        padding: 0.65rem 1rem;
        border: 1px solid #cbd5e1;
        transition: all 0.2s ease;
    }
    .form-control-modern:focus,
    .form-select-modern:focus {
        border-color: #0f2547;
        box-shadow: 0 0 0 4px rgba(15, 37, 71, 0.1);
    }
    /* ==========================================================
       TABELA
       ========================================================== */
    .table-modern th {
        padding: 0.9rem 1.25rem;
        font-weight: 600;
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        white-space: nowrap;
    }
    .table-modern td {
        padding: 0.9rem 1.25rem;
    }
    /* ==========================================================
       BOTÕES DE AÇÃO
       ========================================================== */
    .btn-action {
        width: 34px;
        height: 34px;
        padding: 0;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 0.5rem;
        transition: all 0.2s ease;
    }
    /* ==========================================================
       RESPONSÁVEL
       ========================================================== */
    .responsavel-avatar {
        width: 34px;
        height: 34px;
        min-width: 34px;
        border-radius: 50%;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background-color: rgba(15, 37, 71, 0.08);
        color: #0f2547;
    }
    .responsavel-name {
        font-size: 0.9rem;
        line-height: 1.2;
    }
    .responsavel-cracha {
        font-size: 0.75rem;
    }
</style>
<div class="container-fluid py-2">
    {{-- ==========================================================
         MENSAGEM DE SUCESSO
         ========================================================== --}}
    @if(session('success'))
        <div
            class="alert alert-success border-0 rounded-3 shadow-sm alert-dismissible fade show mb-4 d-flex align-items-center gap-2"
            role="alert"
        >
            <svg
                xmlns="http://www.w3.org/2000/svg"
                width="20"
                height="20"
                fill="currentColor"
                class="bi bi-check-circle-fill flex-shrink-0"
                viewBox="0 0 16 16"
            >
                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l4.992-5.99a.75.75 0 0 0-.018-1.042z"/>
            </svg>
            <div>
                {{ session('success') }}
            </div>
            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert"
                aria-label="Close"
            ></button>
        </div>
    @endif
    {{-- ==========================================================
         MENSAGEM DE ERRO
         ========================================================== --}}
    @if(session('error'))
        <div
            class="alert alert-danger border-0 rounded-3 shadow-sm alert-dismissible fade show mb-4 d-flex align-items-center gap-2"
            role="alert"
        >
            <svg
                xmlns="http://www.w3.org/2000/svg"
                width="20"
                height="20"
                fill="currentColor"
                class="bi bi-exclamation-triangle-fill flex-shrink-0"
                viewBox="0 0 16 16"
            >
                <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
            </svg>
            <div>
                {{ session('error') }}
            </div>
            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert"
                aria-label="Close"
            ></button>
        </div>
    @endif
    {{-- ==========================================================
         CABEÇALHO DA PÁGINA
         ========================================================== --}}
    <div
        class="d-flex justify-content-between align-items-center mb-4 pb-2 border-bottom"
    >
        <div>
            <h2
                class="fw-bold mb-1"
                style="color: #0f2547;"
            >
                Gestão de Computadores
            </h2>
            <p class="text-secondary mb-0 fs-6">
                Gerencie todos os computadores registados no SinTech.
            </p>
        </div>
        {{-- ÚNICO BOTÃO NOVO COMPUTADOR --}}
        <a
            href="{{ route('computers.create') }}"
            class="btn btn-navy d-flex align-items-center gap-2 shadow-sm"
        >
            <svg
                xmlns="http://www.w3.org/2000/svg"
                width="18"
                height="18"
                fill="currentColor"
                class="bi bi-plus-lg"
                viewBox="0 0 16 16"
            >
                <path
                    fill-rule="evenodd"
                    d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2"
                />
            </svg>
            <span>
                Novo Computador
            </span>
        </a>
    </div>
    {{-- ==========================================================
         ÁREA DE PESQUISA E FILTROS
         ========================================================== --}}
    <div class="card card-modern shadow-sm border-0 mb-4 bg-white">
        <div class="card-body p-3 p-md-4">
            <form
                action="{{ route('computers.index') }}"
                method="GET"
            >
                <div class="row g-3">
                    {{-- PESQUISA --}}
                    <div class="col-md-6">
                        <div class="position-relative">
                            <input
                                type="text"
                                name="pesquisa"
                                class="form-control form-control-modern ps-5"
                                placeholder="Pesquisar por plaqueta, modelo ou responsável..."
                                value="{{ $pesquisa ?? '' }}"
                            >
                            <span
                                class="position-absolute top-50 start-0 translate-middle-y ms-3 text-secondary"
                            >
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    width="18"
                                    height="18"
                                    fill="currentColor"
                                    class="bi bi-search"
                                    viewBox="0 0 16 16"
                                >
                                    <path
                                        d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"
                                    />
                                </svg>
                            </span>
                        </div>
                    </div>
                    {{-- ORDENAÇÃO --}}
                    <div class="col-md-4">
                        <select
                            name="ordem"
                            class="form-select form-select-modern"
                        >
                            <option
                                value="plaqueta"
                                {{ ($ordem ?? '') == 'plaqueta' ? 'selected' : '' }}
                            >
                                Ordenar por Plaqueta
                            </option>
                            <option
                                value="modelo_cpu"
                                {{ ($ordem ?? '') == 'modelo_cpu' ? 'selected' : '' }}
                            >
                                Ordenar por Modelo
                            </option>
                            <option
                                value="memoria_gb"
                                {{ ($ordem ?? '') == 'memoria_gb' ? 'selected' : '' }}
                            >
                                Ordenar por Memória
                            </option>
                            <option
                                value="data_entrada"
                                {{ ($ordem ?? '') == 'data_entrada' ? 'selected' : '' }}
                            >
                                Ordenar por Data
                            </option>
                        </select>
                    </div>
                    {{-- BOTÃO FILTRAR --}}
                    <div class="col-md-2 d-grid">
                        <button
                            type="submit"
                            class="btn btn-navy d-flex align-items-center justify-content-center gap-2"
                        >
                            <i class="bi bi-search"></i>
                            <span>
                                Filtrar
                            </span>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    {{-- ==========================================================
         TABELA
         ========================================================== --}}
    <div class="card card-modern shadow-sm border-0 bg-white">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table
                    class="table table-hover table-modern align-middle mb-0"
                >
                    {{-- ==================================================
                         CABEÇALHO DA TABELA
                         ================================================== --}}
                    <thead class="bg-navy-header">
                        <tr>
                            <th>
                                Plaqueta
                            </th>
                            <th>
                                Responsável
                            </th>
                            <th>
                                Modelo CPU
                            </th>
                            <th>
                                Memória
                            </th>
                            <th>
                                Data Entrada
                            </th>
                            <th
                                width="120"
                                class="text-center"
                            >
                                Ações
                            </th>
                        </tr>
                    </thead>
                    {{-- ==================================================
                         CORPO DA TABELA
                         ================================================== --}}
                    <tbody>
                    @forelse($computers as $computer)
                        <tr>
                            {{-- ==========================================
                                 PLAQUETA
                                 ========================================== --}}
                            <td>
                                <span
                                    class="badge bg-light text-dark border font-monospace px-2.5 py-1.5 fs-6"
                                >
                                    {{ $computer->plaqueta }}
                                </span>
                            </td>
                            {{-- ==========================================
                                 RESPONSÁVEL
                                 ========================================== --}}
                            <td>
                                @if($computer->responsavel)
                                    <div
                                        class="d-flex align-items-center gap-2"
                                    >
                                        {{-- Avatar --}}
                                        <div class="responsavel-avatar">
                                            <i class="bi bi-person-fill"></i>
                                        </div>
                                        {{-- Dados --}}
                                        <div>
                                            <div
                                                class="fw-semibold text-dark responsavel-name"
                                            >
                                                {{ $computer->responsavel->name }}
                                            </div>
                                            <div
                                                class="text-secondary responsavel-cracha"
                                            >
                                                <i class="bi bi-person-badge me-1"></i>
                                                {{ $computer->responsavel->numero_cracha }}
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <span
                                        class="badge bg-warning bg-opacity-10 text-warning border border-warning border-opacity-25"
                                    >
                                        <i class="bi bi-exclamation-circle me-1"></i>
                                        Sem responsável
                                    </span>
                                @endif
                            </td>
                            {{-- ==========================================
                                 MODELO CPU
                                 ========================================== --}}
                            <td class="fw-semibold text-dark">
                                {{ $computer->modelo_cpu }}
                            </td>
                            {{-- ==========================================
                                 MEMÓRIA
                                 ========================================== --}}
                            <td>
                                <span
                                    class="badge bg-primary bg-opacity-10 text-primary border border-primary border-opacity-25 px-2.5 py-1.5 fw-bold"
                                    style="font-size: 0.8rem;"
                                >
                                    {{ $computer->memoria_gb }} GB
                                </span>
                            </td>
                            {{-- ==========================================
                                 DATA DE ENTRADA
                                 ========================================== --}}
                            <td class="text-secondary">
                                {{ \Carbon\Carbon::parse($computer->data_entrada)->format('d/m/Y') }}
                            </td>
                            {{-- ==========================================
                                 AÇÕES
                                 ========================================== --}}
                            <td class="text-center">
                                <div
                                    class="d-flex align-items-center justify-content-center gap-1"
                                >
                                    {{-- EDITAR --}}
                                    <a
                                        href="{{ route('computers.edit', $computer->id) }}"
                                        class="btn btn-action btn-outline-warning"
                                        title="Editar"
                                    >
                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            width="16"
                                            height="16"
                                            fill="currentColor"
                                            class="bi bi-pencil-square"
                                            viewBox="0 0 16 16"
                                        >
                                            <path
                                                d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293a.5.5 0 0 1 0 .707l-1.043 1.043z"
                                            />
                                            <path
                                                d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5h6a.5.5 0 0 0 0-1h-6A1.5 1.5 0 0 0 1 2.5z"
                                            />
                                        </svg>
                                    </a>
                                    {{-- ELIMINAR --}}
                                    <form
                                        action="{{ route('computers.destroy', $computer->id) }}"
                                        method="POST"
                                        class="d-inline"
                                    >
                                        @csrf
                                        @method('DELETE')
                                        <button
                                            type="submit"
                                            class="btn btn-action btn-outline-danger"
                                            onclick="return confirm('Pretende eliminar este computador?')"
                                            title="Eliminar"
                                        >
                                            <svg
                                                xmlns="http://www.w3.org/2000/svg"
                                                width="16"
                                                height="16"
                                                fill="currentColor"
                                                class="bi bi-trash-fill"
                                                viewBox="0 0 16 16"
                                            >
                                                <path
                                                    d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1z"
                                                />
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        {{-- ==========================================
                             NENHUM COMPUTADOR
                             ========================================== --}}
                        <tr>
                            <td
                                colspan="6"
                                class="text-center py-5 text-muted"
                            >
                                <div
                                    class="p-3 bg-light rounded-circle d-inline-flex mb-3"
                                >
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        width="36"
                                        height="36"
                                        fill="currentColor"
                                        class="bi bi-pc-display text-secondary"
                                        viewBox="0 0 16 16"
                                    >
                                        <path
                                            d="M8 1a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v14a1 1 0 0 1-1 1H9a1 1 0 0 1-1-1zm1 13.5a.5.5 0 1 0 1 0 .5.5 0 0 0-1 0m2 0a.5.5 0 1 0 1 0 .5.5 0 0 0-1 0M5 12h2a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H1a1 1 0 0 0-1 1v9a1 1 0 0 0 1 1h2v1H1.5a.5.5 0 0 0 0 1h5a.5.5 0 0 0 0-1H5zM1 2h6v9H1z"
                                        />
                                    </svg>
                                </div>
                                <h6 class="fw-bold text-dark mb-1">
                                    Nenhum computador encontrado
                                </h6>
                                <p class="text-secondary small mb-0">
                                    Tente ajustar os termos de pesquisa
                                    ou registe um novo computador.
                                </p>
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
            {{-- ==========================================================
                 PAGINAÇÃO
                 ========================================================== --}}
            @if($computers->hasPages())
                <div
                    class="d-flex justify-content-center p-3 border-top"
                >
                    {{ $computers->links('pagination::bootstrap-5') }}
                </div>
            @endif
        </div>
    </div>
    {{-- ==========================================================
         NAVEGAÇÃO INFERIOR
         ========================================================== --}}
    <div
        class="d-flex justify-content-start align-items-center mt-4"
    >
        {{-- DASHBOARD --}}
        <a
            href="{{ route('dashboard') }}"
            class="btn btn-light border rounded-3 px-3 d-flex align-items-center gap-2"
        >
            <svg
                xmlns="http://www.w3.org/2000/svg"
                width="18"
                height="18"
                fill="currentColor"
                class="bi bi-arrow-left"
                viewBox="0 0 16 16"
            >
                <path
                    fill-rule="evenodd"
                    d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8"
                />
            </svg>
            Voltar ao Dashboard
        </a>
    </div>
</div>
@endsection




