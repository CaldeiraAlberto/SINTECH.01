@extends('layouts.app')

@section('title', 'Detalhes da Aposentação')

@section('content')

<div class="container-fluid py-2">

    {{-- Cabeçalho --}}
    <div class="card shadow-sm border-0 mb-4">

        <div class="card-header bg-danger text-white py-3 px-4 d-flex justify-content-between align-items-center">

            <div class="d-flex align-items-center gap-2">

                <div class="p-2 bg-white bg-opacity-10 rounded-3">

                    <i class="bi bi-archive-fill fs-5"></i>

                </div>

                <div>

                    <h4 class="fw-bold mb-0">
                        Detalhes da Aposentação
                    </h4>

                    <small class="text-white-50">
                        Informação completa do equipamento aposentado
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


        <div class="card-body p-4 p-md-5">

            {{-- Informação do computador --}}
            <div class="mb-4">

                <h5 class="fw-bold mb-3">

                    <i class="bi bi-pc-display me-2"></i>

                    Informações do Computador

                </h5>


                <div class="row g-3">

                    {{-- Plaqueta --}}
                    <div class="col-md-6">

                        <div class="border rounded-3 p-3 bg-light">

                            <small class="text-muted d-block">
                                Plaqueta / Nº de Património
                            </small>

                            <strong class="fs-5">

                                {{ $retirement->computer?->plaqueta ?? 'N/A' }}

                            </strong>

                        </div>

                    </div>


                    {{-- Modelo CPU --}}
                    <div class="col-md-6">

                        <div class="border rounded-3 p-3 bg-light">

                            <small class="text-muted d-block">
                                Modelo do Processador
                            </small>

                            <strong>

                                {{ $retirement->computer?->modelo_cpu ?? 'N/A' }}

                            </strong>

                        </div>

                    </div>


                    {{-- Memória --}}
                    <div class="col-md-6">

                        <div class="border rounded-3 p-3 bg-light">

                            <small class="text-muted d-block">
                                Memória RAM
                            </small>

                            <strong>

                                {{ $retirement->computer?->memoria_gb ?? 'N/A' }}

                                @if($retirement->computer)
                                    GB
                                @endif

                            </strong>

                        </div>

                    </div>


                    {{-- Data de entrada --}}
                    <div class="col-md-6">

                        <div class="border rounded-3 p-3 bg-light">

                            <small class="text-muted d-block">
                                Data de Entrada
                            </small>

                            <strong>

                                @if($retirement->computer?->data_entrada)

                                    {{ $retirement->computer->data_entrada->format('d/m/Y') }}

                                @else

                                    N/A

                                @endif

                            </strong>

                        </div>

                    </div>

                </div>

            </div>


            <hr class="my-4">


            {{-- Responsável --}}
            <div class="mb-4">

                <h5 class="fw-bold mb-3">

                    <i class="bi bi-person-fill me-2"></i>

                    Responsável pelo Computador

                </h5>


                @if($retirement->computer?->responsavel)

                    <div class="row g-3">

                        <div class="col-md-6">

                            <div class="border rounded-3 p-3">

                                <small class="text-muted d-block">
                                    Nome
                                </small>

                                <strong>

                                    {{ $retirement->computer->responsavel->name }}

                                </strong>

                            </div>

                        </div>


                        <div class="col-md-6">

                            <div class="border rounded-3 p-3">

                                <small class="text-muted d-block">
                                    Nº de Crachá
                                </small>

                                <strong>

                                    {{ $retirement->computer->responsavel->numero_cracha }}

                                </strong>

                            </div>

                        </div>


                        <div class="col-md-6">

                            <div class="border rounded-3 p-3">

                                <small class="text-muted d-block">
                                    E-mail
                                </small>

                                <strong>

                                    {{ $retirement->computer->responsavel->email }}

                                </strong>

                            </div>

                        </div>

                    </div>

                @else

                    <div class="alert alert-secondary mb-0">

                        <i class="bi bi-person-x me-2"></i>

                        Este computador não possui um responsável associado.

                    </div>

                @endif

            </div>


            <hr class="my-4">


            {{-- Informações da aposentação --}}
            <div class="mb-4">

                <h5 class="fw-bold mb-3">

                    <i class="bi bi-archive-fill me-2"></i>

                    Informações da Aposentação

                </h5>


                <div class="row g-3">

                    {{-- Data --}}
                    <div class="col-md-6">

                        <div class="border rounded-3 p-3">

                            <small class="text-muted d-block">
                                Data da Aposentação
                            </small>

                            <strong>

                                @if($retirement->data_aposentacao)

                                    {{ $retirement->data_aposentacao->format('d/m/Y') }}

                                @else

                                    N/A

                                @endif

                            </strong>

                        </div>

                    </div>


                    {{-- Motivo --}}
                    <div class="col-md-6">

                        <div class="border rounded-3 p-3">

                            <small class="text-muted d-block">
                                Motivo
                            </small>

                            <span class="badge bg-danger fs-6">

                                {{ $retirement->motivo }}

                            </span>

                        </div>

                    </div>


                    {{-- Observações --}}
                    <div class="col-12">

                        <div class="border rounded-3 p-3">

                            <small class="text-muted d-block mb-2">
                                Observações
                            </small>

                            @if($retirement->observacoes)

                                <div style="white-space: pre-line;">

                                    {{ $retirement->observacoes }}

                                </div>

                            @else

                                <span class="text-muted">

                                    Sem observações.

                                </span>

                            @endif

                        </div>

                    </div>

                </div>

            </div>


            <hr class="my-4">


            {{-- Botões --}}
            <div class="d-flex justify-content-between align-items-center">

                <a
                    href="{{ route('retirements.index') }}"
                    class="btn btn-secondary">

                    <i class="bi bi-arrow-left me-1"></i>

                    Voltar

                </a>


                <div class="d-flex gap-2">

                    <a
                        href="{{ route('retirements.edit', $retirement->id) }}"
                        class="btn btn-warning">

                        <i class="bi bi-pencil-square me-1"></i>

                        Editar

                    </a>


                    <form
                        action="{{ route('retirements.destroy', $retirement->id) }}"
                        method="POST"
                        class="d-inline">

                        @csrf

                        @method('DELETE')

                        <button
                            type="submit"
                            class="btn btn-danger"
                            onclick="return confirm('Pretende eliminar este registo de aposentação?')">

                            <i class="bi bi-trash me-1"></i>

                            Eliminar

                        </button>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection