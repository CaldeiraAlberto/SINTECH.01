@extends('layouts.app')

@section('title', 'Nova Instalação')

@section('content')

<div class="card-header bg-primary text-white">
    <h4 class="mb-0">
        <i class="bi bi-plus-circle-fill me-2"></i>
        Nova Instalação
    </h4>
</div>

<div class="card-body">

    {{-- Erros de Validação --}}
    @if($errors->any())
        <div class="alert alert-danger mb-4">
            <strong>Foram encontrados os seguintes erros:</strong>
            <ul class="mb-0 mt-2">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Formulário --}}
    <form action="{{ route('installations.store') }}" method="POST">
        @csrf

        <div class="row">

            {{-- Computador --}}
            <div class="col-md-6 mb-3">
                <label for="computer_id" class="form-label">
                    Computador
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
                            @selected(old('computer_id') == $computer->id)>
                            {{ $computer->plaqueta }} - {{ $computer->modelo_cpu }} 
                            (Resp: {{ $computer->responsavel->name ?? 'Sem responsável' }})
                        </option>
                    @endforeach
                </select>

                @error('computer_id')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            {{-- Software --}}
            <div class="col-md-6 mb-3">
                <label for="software_id" class="form-label">
                    Software
                </label>

                <select
                    id="software_id"
                    name="software_id"
                    class="form-select @error('software_id') is-invalid @enderror"
                    required>

                    <option value="">
                        Selecione o software...
                    </option>

                    @foreach($softwares as $software)
                        <option
                            value="{{ $software->id }}"
                            @selected(old('software_id') == $software->id)>
                            {{ $software->nome }}
                        </option>
                    @endforeach
                </select>

                @error('software_id')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            {{-- Data da Instalação --}}
            <div class="col-md-6 mb-3">
                <label for="data_instalacao" class="form-label">
                    Data da Instalação
                </label>

                <input
                    type="date"
                    id="data_instalacao"
                    name="data_instalacao"
                    class="form-control @error('data_instalacao') is-invalid @enderror"
                    value="{{ old('data_instalacao', date('Y-m-d')) }}"
                    required>

                @error('data_instalacao')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            {{-- Instalado por --}}
            <div class="col-md-6 mb-3">
                <label for="instalado_por" class="form-label">
                    Instalado por
                </label>

                <input
                    type="text"
                    id="instalado_por"
                    name="instalado_por"
                    class="form-control @error('instalado_por') is-invalid @enderror"
                    value="{{ old('instalado_por') }}"
                    placeholder="Nome do técnico"
                    required>

                @error('instalado_por')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            {{-- Estado --}}
            <div class="col-md-6 mb-3">
                <label for="estado" class="form-label">
                    Estado
                </label>

                <select
                    id="estado"
                    name="estado"
                    class="form-select @error('estado') is-invalid @enderror"
                    required>

                    <option
                        value="Instalado"
                        @selected(old('estado', 'Instalado') == 'Instalado')>
                        Instalado
                    </option>

                    <option
                        value="Atualizado"
                        @selected(old('estado') == 'Atualizado')>
                        Atualizado
                    </option>

                    <option
                        value="Removido"
                        @selected(old('estado') == 'Removido')>
                        Removido
                    </option>
                </select>

                @error('estado')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            {{-- Observações --}}
            <div class="col-12 mb-3">
                <label for="observacoes" class="form-label">
                    Observações
                </label>

                <textarea
                    id="observacoes"
                    name="observacoes"
                    rows="4"
                    class="form-control @error('observacoes') is-invalid @enderror"
                    placeholder="Observações adicionais sobre a instalação...">{{ old('observacoes') }}</textarea>

                @error('observacoes')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

        </div>

        {{-- Botões --}}
        <div class="d-flex justify-content-between mt-3">
            <a
                href="{{ route('installations.index') }}"
                class="btn btn-secondary">
                <i class="bi bi-arrow-left-circle me-1"></i>
                Voltar
            </a>

            <button
                type="submit"
                class="btn btn-success">
                <i class="bi bi-check-circle-fill me-1"></i>
                Guardar Instalação
            </button>
        </div>

    </form>

</div>

@endsection