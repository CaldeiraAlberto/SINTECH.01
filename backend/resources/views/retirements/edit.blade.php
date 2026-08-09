@extends('layouts.app')

@section('title', 'Editar Aposentação')

@section('content')

<div class="container-fluid py-2">

    <div class="card shadow-sm border-0">

        {{-- Cabeçalho --}}
        <div class="card-header bg-warning py-3 px-4 d-flex align-items-center justify-content-between">

            <div class="d-flex align-items-center gap-2">

                <div class="p-2 bg-dark bg-opacity-10 rounded-3">

                    <i class="bi bi-pencil-square fs-5 text-dark"></i>

                </div>

                <div>

                    <h4 class="fw-bold mb-0 text-dark">
                        Editar Aposentação
                    </h4>

                    <small class="text-dark opacity-75">
                        Atualização do registo de aposentação
                    </small>

                </div>

            </div>

            <a
                href="{{ route('retirements.index') }}"
                class="btn btn-dark btn-sm rounded-pill px-3">

                <i class="bi bi-arrow-left me-1"></i>

                Voltar à Lista

            </a>

        </div>


        <div class="card-body p-4 p-md-5">

            {{-- Erros --}}
            @if($errors->any())

                <div class="alert alert-danger border-0 rounded-3 shadow-sm mb-4">

                    <div class="d-flex align-items-center gap-2 mb-2">

                        <i class="bi bi-exclamation-triangle-fill"></i>

                        <strong>
                            Por favor corrija os seguintes erros:
                        </strong>

                    </div>

                    <ul class="mb-0">

                        @foreach($errors->all() as $error)

                            <li>{{ $error }}</li>

                        @endforeach

                    </ul>

                </div>

            @endif


            {{-- Informação --}}
            <div class="alert alert-info border-0 rounded-3 mb-4">

                <div class="d-flex gap-3">

                    <i class="bi bi-info-circle-fill fs-5"></i>

                    <div>

                        <strong>Registo de aposentação</strong>

                        <div class="small mt-1">

                            Confirme os dados do equipamento e atualize
                            o motivo ou as observações quando necessário.

                        </div>

                    </div>

                </div>

            </div>


            {{-- Formulário --}}
            <form
                action="{{ route('retirements.update', $retirement->id) }}"
                method="POST">

                @csrf

                @method('PUT')


                <div class="row g-4">

                    {{-- Computador --}}
                    <div class="col-md-6">

                        <label
                            for="computer_id"
                            class="form-label fw-semibold">

                            Computador
                            <span class="text-danger">*</span>

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
                                    @selected(
                                        old(
                                            'computer_id',
                                            $retirement->computer_id
                                        ) == $computer->id
                                    )>

                                    {{ $computer->plaqueta }}
                                    -
                                    {{ $computer->modelo_cpu }}

                                    @if($computer->responsavel)

                                        —
                                        Responsável:
                                        {{ $computer->responsavel->name }}

                                    @endif

                                </option>

                            @endforeach

                        </select>


                        @error('computer_id')

                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>


                    {{-- Data --}}
                    <div class="col-md-6">

                        <label
                            for="data_aposentacao"
                            class="form-label fw-semibold">

                            Data da Aposentação
                            <span class="text-danger">*</span>

                        </label>


                        <input
                            type="date"
                            id="data_aposentacao"
                            name="data_aposentacao"
                            class="form-control @error('data_aposentacao') is-invalid @enderror"
                            value="{{ old(
                                'data_aposentacao',
                                optional($retirement->data_aposentacao)->format('Y-m-d')
                            ) }}"
                            required>


                        @error('data_aposentacao')

                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>


                    {{-- Motivo --}}
                    <div class="col-12">

                        <label
                            for="motivo"
                            class="form-label fw-semibold">

                            Motivo da Aposentação
                            <span class="text-danger">*</span>

                        </label>


                        <input
                            type="text"
                            id="motivo"
                            name="motivo"
                            class="form-control @error('motivo') is-invalid @enderror"
                            placeholder="Ex.: Equipamento avariado, obsoleto, irrecuperável..."
                            value="{{ old(
                                'motivo',
                                $retirement->motivo
                            ) }}"
                            maxlength="255"
                            required>


                        @error('motivo')

                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>


                    {{-- Observações --}}
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
                            placeholder="Registe informações adicionais...">{{ old(
                                'observacoes',
                                $retirement->observacoes
                            ) }}</textarea>


                        @error('observacoes')

                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>

                </div>


                <hr class="my-4">


                {{-- Botões --}}
                <div class="d-flex justify-content-between align-items-center">

                    <a
                        href="{{ route('retirements.index') }}"
                        class="btn btn-light border">

                        <i class="bi bi-arrow-left me-1"></i>

                        Cancelar

                    </a>


                    <button
                        type="submit"
                        class="btn btn-warning px-4">

                        <i class="bi bi-save-fill me-1"></i>

                        Atualizar Aposentação

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

@endsection