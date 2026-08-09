@extends('layouts.app')
@section('title', 'Relatórios do Sistema')
@section('content')
<div class="container-fluid py-2">
    {{-- CABEÇALHO --}}
    <div class="d-flex justify-content-between align-items-center mb-4 pb-2 border-bottom">
        <div>
            <h2 class="fw-bold mb-1" style="color: #0f2547;">Relatórios do Sistema</h2>
            <p class="text-secondary mb-0 fs-6">Resumo executivo de estatísticas, inventário e instalações do SinTech.</p>
        </div>
        {{-- BOTÃO GERAR PDF --}}
        <a href="{{ route('reports.pdf') }}" class="btn btn-navy d-flex align-items-center gap-2 shadow-sm">
            <i class="bi bi-file-earmark-pdf-fill fs-5"></i>
            <span>Exportar PDF</span>
        </a>
    </div>
    {{-- CARTÕES DE ESTATÍSTICAS --}}
    <div class="row g-3 mb-4">
        <div class="col-md-2">
            <div class="card card-custom p-3 text-center border-0 shadow-sm rounded-4 bg-white">
                <span class="text-muted small fw-semibold text-uppercase">Computadores</span>
                <h3 class="fw-bold mb-0 text-primary mt-1">{{ $totalComputadores }}</h3>
            </div>
        </div>
        <div class="col-md-2">
            <div class="card card-custom p-3 text-center border-0 shadow-sm rounded-4 bg-white">
                <span class="text-muted small fw-semibold text-uppercase">Softwares</span>
                <h3 class="fw-bold mb-0 text-warning mt-1">{{ $totalSoftwares }}</h3>
            </div>
        </div>
        <div class="col-md-2">
            <div class="card card-custom p-3 text-center border-0 shadow-sm rounded-4 bg-white">
                <span class="text-muted small fw-semibold text-uppercase">Instalações</span>
                <h3 class="fw-bold mb-0 text-success mt-1">{{ $totalInstalacoes }}</h3>
            </div>
        </div>
        <div class="col-md-2">
            <div class="card card-custom p-3 text-center border-0 shadow-sm rounded-4 bg-white">
                <span class="text-muted small fw-semibold text-uppercase">Aposentações</span>
                <h3 class="fw-bold mb-0 text-danger mt-1">{{ $totalAposentacoes }}</h3>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card card-custom p-3 text-center border-0 shadow-sm rounded-4 bg-white">
                <span class="text-muted small fw-semibold text-uppercase">Utilizadores Registados</span>
                <h3 class="fw-bold mb-0 text-info mt-1">{{ $totalUtilizadores }}</h3>
            </div>
        </div>
    </div>
    {{-- PESQUISA DE INSTALAÇÕES --}}
    <div class="card card-modern shadow-sm border-0 mb-4 bg-white">
        <div class="card-body p-3">
            <form action="{{ route('reports.index') }}" method="GET" class="row g-2">
                <div class="col-md-10">
                    <input type="text" name="pesquisa" class="form-control form-control-modern" placeholder="Pesquisar em relatórios (computador, software, instalador)..." value="{{ $pesquisa }}">
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-navy w-100">Filtrar</button>
                </div>
            </form>
        </div>
    </div>
    {{-- TABELA DE INSTALAÇÕES RECENTES --}}
    <div class="card card-modern shadow-sm border-0 bg-white mb-4">
        <div class="card-header bg-navy-header py-3 px-4">
            <h5 class="fw-bold mb-0 text-white">Últimas Instalações Registadas</h5>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Computador</th>
                            <th>Software</th>
                            <th>Responsável</th>
                            <th>Instalado Por</th>
                            <th>Data</th>
                            <th>Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($instalacoes as $inst)
                            <tr>
                                <td class="fw-bold">{{ $inst->computer->plaqueta ?? 'N/A' }}</td>
                                <td>{{ $inst->software->nome ?? 'N/A' }}</td>
                                <td>{{ $inst->computer->responsavel->name ?? 'Sem responsável' }}</td>
                                <td>{{ $inst->instalado_por }}</td>
                                <td>{{ \Carbon\Carbon::parse($inst->data_instalacao)->format('d/m/Y') }}</td>
                                <td><span class="badge bg-success">{{ $inst->estado }}</span></td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-4 text-muted">Nenhuma instalação encontrada.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-center p-3">
                {{ $instalacoes->links() }}
            </div>
        </div>
    </div>
</div>
@endsection