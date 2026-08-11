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

    <div class="d-flex align-items-center gap-2">
        {{-- Botão de Eliminar Selecionados (Inicia Oculto) --}}
        <button 
            type="button" 
            id="btnBulkDelete" 
            class="btn btn-danger d-none shadow-sm" 
            data-bs-toggle="modal" 
            data-bs-target="#bulkDeleteModal">
            <i class="bi bi-trash-fill me-1"></i>
            Eliminar Selecionados (<span id="selectedCount">0</span>)
        </button>

        {{-- Botão Novo Software --}}
        <a
            href="{{ route('softwares.create') }}"
            class="btn btn-primary">
            <i class="bi bi-plus-circle-fill me-1"></i>
            Novo Software
        </a>
    </div>
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
        
        {{-- FORMULÁRIO PRINCIPAL DE ELIMINAÇÃO EM MASSA --}}
        <form id="bulkDeleteForm" action="{{ route('softwares.bulk-delete') }}" method="POST">
            @csrf
            @method('DELETE')

            <div class="table-responsive">
                <table class="table table-hover table-striped align-middle">
                    <thead class="table-dark">
                        <tr>
                            {{-- Quadradinho do Cabeçalho (Selecionar Todos) --}}
                            <th width="40" class="text-center">
                                <input type="checkbox" class="form-check-input" id="selectAll" title="Selecionar Todos">
                            </th>
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
                            {{-- Quadradinho Individual --}}
                            <td class="text-center">
                                <input 
                                    type="checkbox" 
                                    class="form-check-input item-checkbox" 
                                    name="ids[]" 
                                    value="{{ $software->id }}">
                            </td>

                            {{-- NOME --}}
                            <td>
                                <div class="fw-semibold">
                                    {{ $software->nome }}
                                </div>
                            </td>

                            {{-- VERSÃO --}}
                            <td>
                                {{ $software->versao }}
                            </td>

                            {{-- FABRICANTE --}}
                            <td>
                                {{ $software->fabricante }}
                            </td>

                            {{-- TIPO --}}
                            <td>
                                <span class="badge bg-secondary">
                                    {{ $software->tipo }}
                                </span>
                            </td>

                            {{-- ESTADO --}}
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

                            {{-- AÇÕES --}}
                            <td>
                                {{-- Editar --}}
                                <a
                                    href="{{ route('softwares.edit', $software->id) }}"
                                    class="btn btn-outline-warning btn-sm"
                                    title="Editar">
                                    <i class="bi bi-pencil-square"></i>
                                </a>

                                {{-- Eliminar Individual --}}
                                <button
                                    type="button"
                                    class="btn btn-outline-danger btn-sm"
                                    title="Eliminar"
                                    onclick="if(confirm('Pretende eliminar este software?')) { document.getElementById('delete-single-{{ $software->id }}').submit(); }">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td
                                colspan="7"
                                class="text-center py-4 text-muted">
                                <i class="bi bi-hdd-stack fs-2 d-block mb-2"></i>
                                Nenhum software registrado.
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </form>

        {{-- FORMULÁRIOS OCULTOS PARA ELIMINAÇÃO INDIVIDUAL (Para não conflituar com o form principal) --}}
        @foreach($softwares as $software)
            <form id="delete-single-{{ $software->id }}" action="{{ route('softwares.destroy', $software->id) }}" method="POST" class="d-none">
                @csrf
                @method('DELETE')
            </form>
        @endforeach

        {{-- PAGINAÇÃO --}}
        <div class="d-flex justify-content-center mt-4">
            {{ $softwares->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>

{{-- ========================================================= --}}
{{-- MODAL DE CONFIRMAÇÃO PARA ELIMINAÇÃO EM MASSA --}}
{{-- ========================================================= --}}

<div class="modal fade" id="bulkDeleteModal" tabindex="-1" aria-labelledby="bulkDeleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title fw-bold" id="bulkDeleteModalLabel">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i> Confirmar Eliminação
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body py-4">
                <p class="mb-0 fs-6">
                    Tem certeza de que pretende eliminar os <strong id="bulkModalCount" class="text-danger">0</strong> software(s) selecionado(s)?
                </p>
                <small class="text-muted d-block mt-2">Esta ação não poderá ser desfeita.</small>
            </div>
            <div class="modal-footer bg-light">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-danger" onclick="document.getElementById('bulkDeleteForm').submit();">
                    <i class="bi bi-trash me-1"></i> Sim, Eliminar Todos
                </button>
            </div>
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

{{-- ========================================================= --}}
{{-- JAVASCRIPT DOS QUADRADINHOS --}}
{{-- ========================================================= --}}

<script>
document.addEventListener('DOMContentLoaded', function () {
    const selectAll = document.getElementById('selectAll');
    const checkboxes = document.querySelectorAll('.item-checkbox');
    const btnBulkDelete = document.getElementById('btnBulkDelete');
    const selectedCountSpan = document.getElementById('selectedCount');
    const bulkModalCount = document.getElementById('bulkModalCount');

    function updateBulkButton() {
        const checkedBoxes = document.querySelectorAll('.item-checkbox:checked');
        const checkedCount = checkedBoxes.length;

        if (selectedCountSpan) selectedCountSpan.textContent = checkedCount;
        if (bulkModalCount) bulkModalCount.textContent = checkedCount;

        if (checkedCount > 0) {
            btnBulkDelete.classList.remove('d-none');
        } else {
            btnBulkDelete.classList.add('d-none');
        }
    }

    if (selectAll) {
        selectAll.addEventListener('change', function () {
            checkboxes.forEach(cb => cb.checked = this.checked);
            updateBulkButton();
        });
    }

    checkboxes.forEach(cb => {
        cb.addEventListener('change', function () {
            const allChecked = Array.from(checkboxes).length > 0 && Array.from(checkboxes).every(c => c.checked);
            if (selectAll) selectAll.checked = allChecked;
            updateBulkButton();
        });
    });
});
</script>

@endsection