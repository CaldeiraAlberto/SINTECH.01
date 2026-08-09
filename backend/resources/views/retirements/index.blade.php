@extends('layouts.app')
@section('title', 'Gestão de Aposentações')
@section('content')
<div class="container-fluid py-2">
    {{-- Mensagem de Sucesso --}}
    @if(session('success'))
        <div class="alert alert-success border-0 rounded-3 shadow-sm alert-dismissible fade show mb-4 d-flex align-items-center gap-2" role="alert">
            <i class="bi bi-check-circle-fill flex-shrink-0"></i>
            <div>{{ session('success') }}</div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    {{-- Mensagem de Erro --}}
    @if(session('error'))
        <div class="alert alert-danger border-0 rounded-3 shadow-sm alert-dismissible fade show mb-4 d-flex align-items-center gap-2" role="alert">
            <i class="bi bi-exclamation-triangle-fill flex-shrink-0"></i>
            <div>{{ session('error') }}</div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    {{-- Cabeçalho da Página --}}
    <div class="d-flex justify-content-between align-items-center mb-4 pb-2 border-bottom">
        <div>
            <h2 class="fw-bold mb-1" style="color: #0f2547;">Gestão de Aposentações</h2>
            <p class="text-secondary mb-0 fs-6">Gerencie todos os computadores retirados de serviço no SinTech.</p>
        </div>
        {{-- BOTÃO NOVA APOSENTAÇÃO (EM AZUL) --}}
        <a href="{{ route('retirements.create') }}" class="btn btn-primary d-flex align-items-center gap-2 shadow-sm fw-semibold">
            <i class="bi bi-plus-lg"></i>
            <span>Nova Aposentação</span>
        </a>
    </div>
    {{-- Área de Pesquisa --}}
    <div class="card card-modern shadow-sm border-0 mb-4 bg-white">
        <div class="card-body p-3 p-md-4">
            <form action="{{ route('retirements.index') }}" method="GET">
                <div class="row g-3">
                    <div class="col-md-9">
                        <input type="text"
                               name="pesquisa"
                               class="form-control form-control-modern"
                               placeholder="Pesquisar por computador, responsável, motivo ou observação..."
                               value="{{ $pesquisa ?? '' }}">
                    </div>
                    <div class="col-md-3 d-grid">
                        <button type="submit" class="btn btn-navy d-flex align-items-center justify-content-center gap-2">
                            <i class="bi bi-search"></i>
                            <span>Pesquisar</span>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    {{-- Tabela de Aposentações --}}
    <div class="card card-modern shadow-sm border-0 bg-white">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover table-modern align-middle mb-0">
                    <thead class="bg-navy-header">
                        <tr>
                            <th>Computador</th>
                            <th>Responsável</th>
                            <th>Data Aposentação</th>
                            <th>Motivo</th>
                            <th>Observações</th>
                            <th width="120" class="text-center">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                    @forelse($retirements as $retirement)
                        <tr>
                            {{-- Computador --}}
                            <td>
                                @if($retirement->computer)
                                    <div class="fw-semibold text-dark">
                                        <i class="bi bi-pc-display me-1"></i>
                                        {{ $retirement->computer->plaqueta }}
                                    </div>
                                    <small class="text-muted">
                                        {{ $retirement->computer->modelo_cpu }}
                                    </small>
                                @else
                                    <span class="text-muted">Computador não encontrado</span>
                                @endif
                            </td>
                            {{-- Responsável --}}
                            <td>
                                @if($retirement->computer?->responsavel)
                                    <div class="fw-semibold text-dark">
                                        <i class="bi bi-person-fill me-1"></i>
                                        {{ $retirement->computer->responsavel->name }}
                                    </div>
                                    <small class="text-muted">
                                        Crachá: {{ $retirement->computer->responsavel->numero_cracha }}
                                    </small>
                                @else
                                    <span class="text-muted">Não definido</span>
                                @endif
                            </td>
                            {{-- Data --}}
                            <td>
                                @if($retirement->data_aposentacao)
                                    <span class="badge bg-light text-dark border">
                                        {{ \Carbon\Carbon::parse($retirement->data_aposentacao)->format('d/m/Y') }}
                                    </span>
                                @else
                                    <span class="text-muted">Não definida</span>
                                @endif
                            </td>
                            {{-- Motivo --}}
                            <td>
                                <span class="badge bg-danger bg-opacity-10 text-danger border border-danger border-opacity-25 fw-bold">
                                    {{ $retirement->motivo }}
                                </span>
                            </td>
                            {{-- Observações --}}
                            <td>
                                @if($retirement->observacoes)
                                    {{ \Illuminate\Support\Str::limit($retirement->observacoes, 50) }}
                                @else
                                    <span class="text-muted">Sem observações</span>
                                @endif
                            </td>
                            {{-- Ações --}}
                            <td class="text-center">
                                <div class="d-flex align-items-center justify-content-center gap-1">
                                    {{-- ELIMINAR --}}
                                    <form action="{{ route('retirements.destroy', $retirement->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="btn btn-action btn-outline-danger"
                                                onclick="return confirm('Pretende eliminar este registo de aposentação?')"
                                                title="Eliminar">
                                            <i class="bi bi-trash-fill"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-5 text-muted">
                                <div class="p-3 bg-light rounded-circle d-inline-flex mb-3">
                                    <i class="bi bi-archive fs-1 text-secondary"></i>
                                </div>
                                <h6 class="fw-bold text-dark mb-1">Nenhuma aposentação registada</h6>
                                <p class="text-secondary small mb-0">Os computadores retirados de serviço aparecerão aqui.</p>
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
            {{-- Paginação --}}
            @if($retirements->hasPages())
                <div class="d-flex justify-content-center p-3 border-top">
                    {{ $retirements->links('pagination::bootstrap-5') }}
                </div>
            @endif
        </div>
    </div>
    {{-- Navegação Inferior --}}
    <div class="d-flex justify-content-start align-items-center mt-4">
        <a href="{{ route('dashboard') }}" class="btn btn-light border rounded-3 px-3 d-flex align-items-center gap-2">
            <i class="bi bi-arrow-left"></i>
            <span>Voltar ao Dashboard</span>
        </a>
    </div>
</div>
@endsection
