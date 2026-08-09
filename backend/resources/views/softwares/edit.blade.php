@extends('layouts.app')

@section('title', 'Editar Software')

@section('content')

<div class="card shadow-sm border-0">

    <div class="card-header bg-warning">

        <h4 class="mb-0">
            <i class="bi bi-pencil-square me-2"></i>
            Editar Software
        </h4>

    </div>

    <div class="card-body">

        {{-- Erros de Validação Gerais --}}
        @if($errors->any())

            <div class="alert alert-danger mb-4">

                <ul class="mb-0">

                    @foreach($errors->all() as $error)

                        <li>{{ $error }}</li>

                    @endforeach

                </ul>

            </div>

        @endif


        {{-- Formulário --}}
        <form action="{{ route('softwares.update', $software->id) }}"
              method="POST">

            @csrf

            @method('PUT')


            <div class="row">

                {{-- Nome do Software --}}
                <div class="col-md-6 mb-3">

                    <label for="nome" class="form-label">
                        Nome do Software
                    </label>

                    <input
                        type="text"
                        id="nome"
                        name="nome"
                        class="form-control @error('nome') is-invalid @enderror"
                        value="{{ old('nome', $software->nome) }}"
                        required>

                    @error('nome')

                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>

                    @enderror

                </div>


                {{-- Versão --}}
                <div class="col-md-6 mb-3">

                    <label for="versao" class="form-label">
                        Versão
                    </label>

                    <input
                        type="text"
                        id="versao"
                        name="versao"
                        class="form-control @error('versao') is-invalid @enderror"
                        value="{{ old('versao', $software->versao) }}"
                        required>

                    @error('versao')

                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>

                    @enderror

                </div>


                {{-- Fabricante --}}
                <div class="col-md-6 mb-3">

                    <label for="fabricante" class="form-label">
                        Fabricante
                    </label>

                    <input
                        type="text"
                        id="fabricante"
                        name="fabricante"
                        class="form-control @error('fabricante') is-invalid @enderror"
                        value="{{ old('fabricante', $software->fabricante) }}"
                        required>

                    @error('fabricante')

                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>

                    @enderror

                </div>


                {{-- Licença --}}
                <div class="col-md-6 mb-3">

                    <label for="licenca" class="form-label">
                        Licença
                    </label>

                    <input
                        type="text"
                        id="licenca"
                        name="licenca"
                        class="form-control @error('licenca') is-invalid @enderror"
                        value="{{ old('licenca', $software->licenca) }}">

                    @error('licenca')

                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>

                    @enderror

                </div>


                {{-- Tipo --}}
                <div class="col-md-6 mb-3">

                    <label for="tipo" class="form-label">
                        Tipo
                    </label>

                    <select
                        id="tipo"
                        name="tipo"
                        class="form-select @error('tipo') is-invalid @enderror"
                        required>

                        <option value="Sistema Operativo"
                            @selected(old('tipo', $software->tipo) == 'Sistema Operativo')}>
                            Sistema Operativo
                        </option>

                        <option value="Aplicação"
                            @selected(old('tipo', $software->tipo) == 'Aplicação')}>
                            Aplicação
                        </option>

                        <option value="Antivírus"
                            @selected(old('tipo', $software->tipo) == 'Antivírus')}>
                            Antivírus
                        </option>

                        <option value="Driver"
                            @selected(old('tipo', $software->tipo) == 'Driver')}>
                            Driver
                        </option>

                        <option value="Utilitário"
                            @selected(old('tipo', $software->tipo) == 'Utilitário')}>
                            Utilitário
                        </option>

                    </select>

                    @error('tipo')

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

                        <option value="Ativo"
                            @selected(old('estado', $software->estado) == 'Ativo')}>
                            Ativo
                        </option>

                        <option value="Expirado"
                            @selected(old('estado', $software->estado) == 'Expirado')}>
                            Expirado
                        </option>

                        <option value="Descontinuado"
                            @selected(old('estado', $software->estado) == 'Descontinuado')}>
                            Descontinuado
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
                        class="form-control @error('observacoes') is-invalid @enderror">{{ old('observacoes', $software->observacoes) }}</textarea>

                    @error('observacoes')

                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>

                    @enderror

                </div>

            </div>


            {{-- Botões --}}
            <div class="d-flex justify-content-between mt-3">

                <a href="{{ route('softwares.index') }}"
                   class="btn btn-secondary">

                    <i class="bi bi-arrow-left-circle me-1"></i>
                    Voltar

                </a>

                <button type="submit"
                        class="btn btn-warning">

                    <i class="bi bi-save-fill me-1"></i>
                    Atualizar Software

                </button>

            </div>

        </form>

    </div>

</div>

@endsection