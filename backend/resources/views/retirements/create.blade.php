@extends('layouts.app')

@section('title', 'Nova Aposentação')

@section('content')

<style>
    .retirement-card {
        border-radius: 1rem;
        overflow: hidden;
    }

    .retirement-header {
        background-color: #dc3545;
        color: #ffffff;
    }

    .form-control,
    .form-select {
        border-radius: 0.65rem;
        padding: 0.7rem 0.9rem;
    }

    .form-control:focus,
    .form-select:focus {
        border-color: #dc3545;
        box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.12);
    }

    .responsavel-info {
        background-color: #f8f9fa;
        border: 1px solid #dee2e6;
        border-radius: 0.75rem;
        padding: 0.85rem 1rem;
    }

    .responsavel-info .label {
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: #6c757d;
        font-weight: 700;
    }

    .responsavel-info .name {
        font-weight: 600;
        color: #212529;
    }

    .responsavel-info .badge-number {
        font-family: monospace;
        background-color: #e9ecef;
        color: #495057;
        padding: 0.2rem 0.45rem;
        border-radius: 0.35rem;
    }
</style>


<div class="card retirement-card shadow-sm border-0">

    {{-- ========================================================= --}}
    {{-- CABEÇALHO --}}
    {{-- ========================================================= --}}

    <div class="card-header retirement-header py-3 px-4
                d-flex align-items-center justify-content-between">

        <div class="d-flex align-items-center gap-2">

            <div class="p-2 bg-white bg-opacity-10 rounded-3">

                <i class="bi bi-archive-fill fs-5"></i>

            </div>

            <div>

                <h4 class="fw-bold mb-0">
                    Nova Aposentação
                </h4>

                <small class="text-white-50">
                    Registo de um equipamento retirado de utilização
                </small>

            </div>

        </div>


        <a
            href="{{ route('retirements.index') }}"
            class="btn btn-outline-light btn-sm rounded-pill px-3">

            <i class="bi bi-arrow-left me-1"></i>

            Voltar à Lista

        </a>

    </div>


    {{-- ========================================================= --}}
    {{-- CORPO --}}
    {{-- ========================================================= --}}

    <div class="card-body p-4 p-md-5">


        {{-- ===================================================== --}}
        {{-- ERROS DE VALIDAÇÃO --}}
        {{-- ===================================================== --}}

        @if($errors->any())

            <div class="alert alert-danger border-0 rounded-3 shadow-sm mb-4">

                <div class="d-flex align-items-center gap-2 mb-2">

                    <i class="bi bi-exclamation-triangle-fill"></i>

                    <strong>
                        Por favor, corrija os seguintes erros:
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


        {{-- ===================================================== --}}
        {{-- MENSAGEM DE ATENÇÃO --}}
        {{-- ===================================================== --}}

        <div class="alert alert-warning border-0 rounded-3 mb-4">

            <div class="d-flex gap-3">

                <i class="bi bi-info-circle-fill fs-5"></i>

                <div>

                    <strong>Atenção</strong>

                    <div class="small mt-1">

                        Ao aposentar um computador, será criado um
                        registo permanente da aposentação do equipamento.

                        O computador não aparecerá novamente na lista
                        de computadores disponíveis para aposentação.

                    </div>

                </div>

            </div>

        </div>


        {{-- ===================================================== --}}
        {{-- FORMULÁRIO --}}
        {{-- ===================================================== --}}

        <form
            action="{{ route('retirements.store') }}"
            method="POST">

            @csrf


            <div class="row g-4">


                {{-- ================================================= --}}
                {{-- COMPUTADOR --}}
                {{-- ================================================= --}}

                <div class="col-md-6">

                    <label
                        for="computer_id"
                        class="form-label fw-semibold">

                        Computador

                        <span class="text-danger">
                            *
                        </span>

                    </label>


                    <select
                        id="computer_id"
                        name="computer_id"
                        class="form-select @error('computer_id') is-invalid @enderror"
                        required>

                        <option value="">
                            Selecione o computador...
                        </option>


                        @foreach($computers as $computer)

                            <option
                                value="{{ $computer->id }}"
                                data-responsavel="{{ $computer->responsavel->name ?? 'Não definido' }}"
                                data-cracha="{{ $computer->responsavel->numero_cracha ?? 'N/A' }}"
                                data-modelo="{{ $computer->modelo_cpu }}"
                                @selected(old('computer_id') == $computer->id)
                            >

                                {{ $computer->plaqueta }}
                                -
                                {{ $computer->modelo_cpu }}

                                @if($computer->responsavel)

                                    — {{ $computer->responsavel->name }}

                                @endif

                            </option>

                        @endforeach

                    </select>


                    @error('computer_id')

                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>

                    @enderror


                    <div class="form-text">

                        Apenas computadores que ainda não foram
                        aposentados aparecem nesta lista.

                    </div>

                </div>


                {{-- ================================================= --}}
                {{-- RESPONSÁVEL --}}
                {{-- ================================================= --}}

                <div class="col-md-6">

                    <label class="form-label fw-semibold">

                        Responsável da Máquina

                    </label>


                    <div
                        id="responsavel-info"
                        class="responsavel-info">

                        <div class="label">
                            Responsável
                        </div>

                        <div
                            id="responsavel-nome"
                            class="name mt-1">

                            Selecione primeiro um computador

                        </div>


                        <div class="mt-2">

                            <span class="label me-2">
                                N.º Crachá
                            </span>

                            <span
                                id="responsavel-cracha"
                                class="badge-number">

                                —

                            </span>

                        </div>

                    </div>

                </div>


                {{-- ================================================= --}}
                {{-- DATA DA APOSENTAÇÃO --}}
                {{-- ================================================= --}}

                <div class="col-md-6">

                    <label
                        for="data_aposentacao"
                        class="form-label fw-semibold">

                        Data da Aposentação

                        <span class="text-danger">
                            *
                        </span>

                    </label>


                    <input
                        type="date"
                        id="data_aposentacao"
                        name="data_aposentacao"
                        class="form-control @error('data_aposentacao') is-invalid @enderror"
                        value="{{ old('data_aposentacao', date('Y-m-d')) }}"
                        required>


                    @error('data_aposentacao')

                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>

                    @enderror

                </div>


                {{-- ================================================= --}}
                {{-- MOTIVO --}}
                {{-- ================================================= --}}

                <div class="col-md-6">

                    <label
                        for="motivo"
                        class="form-label fw-semibold">

                        Motivo da Aposentação

                        <span class="text-danger">
                            *
                        </span>

                    </label>


                    <input
                        type="text"
                        id="motivo"
                        name="motivo"
                        class="form-control @error('motivo') is-invalid @enderror"
                        placeholder="Ex.: Equipamento avariado, obsoleto, irrecuperável..."
                        value="{{ old('motivo') }}"
                        maxlength="255"
                        required>


                    @error('motivo')

                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>

                    @enderror

                </div>


                {{-- ================================================= --}}
                {{-- OBSERVAÇÕES --}}
                {{-- ================================================= --}}

                <div class="col-12">

                    <label
                        for="observacoes"
                        class="form-label fw-semibold">

                        Observações

                    </label>


                    <textarea
                        id="observacoes"
                        name="observacoes"
                        rows="5"
                        class="form-control @error('observacoes') is-invalid @enderror"
                        placeholder="Registe informações adicionais sobre a aposentação..."
                    >{{ old('observacoes') }}</textarea>


                    @error('observacoes')

                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>

                    @enderror

                </div>

            </div>


            <hr class="my-4">


            {{-- ===================================================== --}}
            {{-- BOTÕES --}}
            {{-- ===================================================== --}}

            <div class="d-flex justify-content-between align-items-center">

                <a
                    href="{{ route('retirements.index') }}"
                    class="btn btn-light border">

                    <i class="bi bi-arrow-left me-1"></i>

                    Cancelar

                </a>


                <button
                    type="submit"
                    class="btn btn-danger px-4">

                    <i class="bi bi-archive-fill me-1"></i>

                    Registar Aposentação

                </button>

            </div>

        </form>

    </div>

</div>


{{-- ============================================================= --}}
{{-- JAVASCRIPT --}}
{{-- ============================================================= --}}

<script>

document.addEventListener('DOMContentLoaded', function () {

    const computadorSelect =
        document.getElementById('computer_id');

    const responsavelNome =
        document.getElementById('responsavel-nome');

    const responsavelCracha =
        document.getElementById('responsavel-cracha');


    function atualizarResponsavel() {

        const option =
            computadorSelect.options[
                computadorSelect.selectedIndex
            ];


        if (
            !option ||
            !option.value
        ) {

            responsavelNome.textContent =
                'Selecione primeiro um computador';

            responsavelCracha.textContent =
                '—';

            return;
        }


        const nome =
            option.dataset.responsavel || 'Não definido';

        const cracha =
            option.dataset.cracha || 'N/A';


        responsavelNome.textContent =
            nome;

        responsavelCracha.textContent =
            cracha;
    }


    computadorSelect.addEventListener(
        'change',
        atualizarResponsavel
    );


    /*
    |--------------------------------------------------------------------------
    | Executar ao carregar a página
    |--------------------------------------------------------------------------
    |
    | Necessário quando existe old('computer_id') depois
    | de um erro de validação.
    |
    */

    atualizarResponsavel();

});

</script>

@endsection