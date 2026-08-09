@extends('layouts.app')

@section('title', 'Editar Computador')

@section('content')

<style>
    .card-form-modern {
        border-radius: 1rem !important;
        overflow: hidden;
    }

    .bg-navy-header {
        background-color: #0f2547 !important;
        color: #ffffff !important;
    }

    .form-control-modern,
    .form-select.form-control-modern {
        border-radius: 0.65rem;
        padding: 0.75rem 1rem;
        border: 1px solid #cbd5e1;
        transition: all 0.2s ease;
    }

    .form-control-modern:focus,
    .form-select.form-control-modern:focus {
        border-color: #0f2547;
        box-shadow: 0 0 0 4px rgba(15, 37, 71, 0.1);
    }

    .form-control-readonly {
        background-color: #f1f5f9 !important;
        color: #64748b !important;
        cursor: not-allowed;
    }

    .btn-navy-submit {
        background-color: #0f2547;
        color: #ffffff;
        border: none;
        border-radius: 0.65rem;
        padding: 0.75rem 1.5rem;
        font-weight: 600;
        transition: all 0.2s ease;
    }

    .btn-navy-submit:hover {
        background-color: #163869;
        color: #ffffff;
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(15, 37, 71, 0.2);
    }

    .btn-light-back {
        border-radius: 0.65rem;
        padding: 0.75rem 1.25rem;
        font-weight: 500;
    }

    .responsavel-info {
        font-size: 0.8rem;
        color: #64748b;
    }
</style>

<div class="container-fluid py-2">

    <div class="card card-form-modern shadow-sm border-0 bg-white">

        {{-- Cabeçalho --}}
        <div class="card-header bg-navy-header py-3 px-4 d-flex align-items-center justify-content-between">

            <div class="d-flex align-items-center gap-2">

                <div class="p-2 bg-white bg-opacity-10 rounded-3 text-white">

                    <i class="bi bi-pencil-square fs-4"></i>

                </div>

                <div>

                    <h4 class="fw-bold mb-0 text-white">
                        Editar Computador
                    </h4>

                    <small class="text-white-50">
                        Equipamento:
                        <span class="badge bg-light text-dark font-monospace">
                            {{ $computer->plaqueta }}
                        </span>
                    </small>

                </div>

            </div>

            <a
                href="{{ route('computers.index') }}"
                class="btn btn-outline-light btn-sm rounded-pill px-3"
            >
                Voltar à Lista
            </a>

        </div>

        {{-- Corpo --}}
        <div class="card-body p-4 p-md-5">

            {{-- Erros --}}
            @if($errors->any())

                <div class="alert alert-danger border-0 rounded-3 shadow-sm mb-4 p-3">

                    <div class="d-flex align-items-center gap-2 mb-2">

                        <i class="bi bi-exclamation-triangle-fill"></i>

                        <strong>
                            Por favor corrija os seguintes erros:
                        </strong>

                    </div>

                    <ul class="mb-0 ps-4">

                        @foreach($errors->all() as $error)

                            <li>
                                {{ $error }}
                            </li>

                        @endforeach

                    </ul>

                </div>

            @endif

            {{-- Formulário --}}
            <form
                action="{{ route('computers.update', $computer->id) }}"
                method="POST"
            >

                @csrf

                @method('PUT')

                <div class="row g-4">

                    {{-- RESPONSÁVEL --}}
                    <div class="col-md-6">

                        <label
                            for="responsavel_id"
                            class="form-label text-dark fw-semibold"
                        >
                            Responsável pelo Computador
                            <span class="text-danger">*</span>
                        </label>

                        <select
                            id="responsavel_id"
                            name="responsavel_id"
                            class="form-select form-control-modern @error('responsavel_id') is-invalid @enderror"
                            required
                        >

                            <option value="">
                                Selecione o responsável...
                            </option>

                            @foreach($responsaveis as $responsavel)

                                <option
                                    value="{{ $responsavel->id }}"
                                    @selected(
                                        old(
                                            'responsavel_id',
                                            $computer->responsavel_id
                                        ) == $responsavel->id
                                    )
                                >
                                    {{ $responsavel->name }}
                                    — {{ $responsavel->numero_cracha }}

                                    @if(
                                        $responsavel->id == $computer->responsavel_id &&
                                        !$responsavel->ativo
                                    )
                                        — Responsável atual
                                    @endif
                                </option>

                            @endforeach

                        </select>

                        @error('responsavel_id')

                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>

                        @enderror

                        <div class="responsavel-info mt-1">

                            <i class="bi bi-info-circle me-1"></i>

                            Apenas utilizadores com perfil
                            <strong>Responsável</strong>
                            e estado ativo podem ser selecionados.

                        </div>

                    </div>

                    {{-- PLAQUETA --}}
                    <div class="col-md-6">

                        <label
                            for="plaqueta"
                            class="form-label text-dark fw-semibold"
                        >
                            Plaqueta / N.º de Património
                            <span class="text-danger">*</span>
                        </label>

                        <input
                            type="text"
                            id="plaqueta"
                            name="plaqueta"
                            class="form-control form-control-modern form-control-readonly"
                            value="{{ old('plaqueta', $computer->plaqueta) }}"
                            readonly
                        >

                        <small class="text-muted">
                            <i class="bi bi-lock-fill me-1"></i>
                            A plaqueta não pode ser alterada.
                        </small>

                    </div>

                    {{-- CPU --}}
                    <div class="col-md-6">

                        <label
                            for="modelo_cpu"
                            class="form-label text-dark fw-semibold"
                        >
                            Modelo do Processador (CPU)
                            <span class="text-danger">*</span>
                        </label>

                        <input
                            type="text"
                            id="modelo_cpu"
                            name="modelo_cpu"
                            class="form-control form-control-modern @error('modelo_cpu') is-invalid @enderror"
                            value="{{ old('modelo_cpu', $computer->modelo_cpu) }}"
                            required
                        >

                        @error('modelo_cpu')

                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>

                    {{-- MEMÓRIA --}}
                    <div class="col-md-6">

                        <label
                            for="memoria_gb"
                            class="form-label text-dark fw-semibold"
                        >
                            Memória RAM (GB)
                            <span class="text-danger">*</span>
                        </label>

                        <div class="input-group">

                            <input
                                type="number"
                                id="memoria_gb"
                                name="memoria_gb"
                                class="form-control form-control-modern @error('memoria_gb') is-invalid @enderror"
                                value="{{ old('memoria_gb', $computer->memoria_gb) }}"
                                min="1"
                                required
                            >

                            <span class="input-group-text bg-light">
                                GB
                            </span>

                        </div>

                        @error('memoria_gb')

                            <div class="invalid-feedback d-block">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>

                    {{-- DATA --}}
                    <div class="col-md-6">

                        <label
                            for="data_entrada"
                            class="form-label text-dark fw-semibold"
                        >
                            Data de Entrada
                            <span class="text-danger">*</span>
                        </label>

                        <input
                            type="date"
                            id="data_entrada"
                            name="data_entrada"
                            class="form-control form-control-modern @error('data_entrada') is-invalid @enderror"
                            value="{{ old('data_entrada', $computer->data_entrada?->format('Y-m-d')) }}"
                            required
                        >

                        @error('data_entrada')

                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>

                </div>

                <hr class="my-4">

                {{-- Informação --}}
                <div class="alert alert-light border rounded-3 d-flex align-items-start gap-2 mb-4">

                    <i class="bi bi-shield-check text-success fs-5"></i>

                    <div>

                        <div class="fw-semibold text-dark">
                            Associação do equipamento
                        </div>

                        <small class="text-muted">
                            O computador está associado ao responsável
                            selecionado. A alteração do responsável só pode
                            ser feita para um utilizador com perfil
                            <strong>Responsável</strong> e estado
                            <strong>ativo</strong>.
                        </small>

                    </div>

                </div>

                {{-- Botões --}}
                <div class="d-flex justify-content-between align-items-center">

                    <a
                        href="{{ route('computers.index') }}"
                        class="btn btn-light border btn-light-back"
                    >
                        <i class="bi bi-arrow-left me-1"></i>
                        Cancelar
                    </a>

                    <button
                        type="submit"
                        class="btn btn-navy-submit d-flex align-items-center gap-2 shadow-sm"
                    >
                        <i class="bi bi-check-lg"></i>
                        Atualizar Computador
                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

@endsection