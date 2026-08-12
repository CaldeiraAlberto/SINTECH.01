@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<style>
    :root {
        --navy-dark: #0f2547;
        --navy-primary: #1e3e70;
    }
    
    .stat-card {
        transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
        border-radius: 0.85rem !important;
        border: 1px solid #e2e8f0 !important;
        position: relative;
    }
    
    .stat-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 24px -6px rgba(15, 37, 71, 0.15) !important;
        border-color: #cbd5e1 !important;
    }
    
    .icon-shape-navy {
        width: 48px;
        height: 48px;
        border-radius: 0.75rem;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: rgba(15, 37, 71, 0.08);
        color: #0f2547;
    }
    
    .card-modern {
        border-radius: 0.85rem !important;
        overflow: hidden;
    }
    
    .bg-navy-header {
        background-color: #0f2547 !important;
        color: #ffffff !important;
    }
    
    .badge-navy {
        background-color: rgba(15, 37, 71, 0.1);
        color: #0f2547;
        border: 1px solid rgba(15, 37, 71, 0.2);
    }
</style>

<div class="container-fluid py-2">
    {{-- CABEÇALHO --}}
    <div class="d-flex justify-content-between align-items-center mb-4 pb-3 border-bottom border-light">
        <div>
            <h2 class="fw-bold mb-1" style="color: #0f2547;">Dashboard</h2>
            <p class="text-secondary mb-0 fs-6">
                Bem-vindo ao <strong>Sistema de Informação para o Registo e Gestão dos Softwares - SinTech</strong>
            </p>
        </div>
        <div class="d-flex align-items-center gap-3 bg-white p-2 px-3 rounded-3 shadow-sm border border-light">
            <div class="avatar-circle rounded-circle d-flex align-items-center justify-content-center fw-bold text-white fs-6" style="width: 42px; height: 42px; background-color: #0f2547;">
                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
            </div>
            <div class="text-end">
                <small class="text-muted d-block lh-1" style="font-size: 0.75rem;">Utilizador Autenticado</small>
                <span class="fw-bold fs-6" style="color: #0f2547;">{{ Auth::user()->name }}</span>
            </div>
        </div>
    </div>

    {{-- CARTÕES KPIs INTERATIVOS --}}
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-xl-6 g-3 mb-4">
        {{-- Computadores --}}
        <div class="col">
            <div class="card card-modern border-0 shadow-sm stat-card bg-white h-100">
                <div class="card-body p-3 d-flex align-items-center justify-content-between">
                    <div>
                        <span class="text-muted text-uppercase fw-semibold d-block" style="font-size: 0.68rem; letter-spacing: 0.5px;">Computadores</span>
                        <h3 class="fw-bold mb-0 mt-1" style="color: #0f2547;">{{ $totalComputers }}</h3>
                        <a href="{{ route('computers.index') }}" class="stretched-link"></a>
                    </div>
                    <div class="icon-shape-navy">
                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-pc-display" viewBox="0 0 16 16">
                            <path d="M8 1a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v14a1 1 0 0 1-1 1H9a1 1 0 0 1-1-1zm1 13.5a.5.5 0 1 0 1 0 .5.5 0 0 0-1 0m2 0a.5.5 0 1 0 1 0 .5.5 0 0 0-1 0M5 12h2a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H1a1 1 0 0 0-1 1v9a1 1 0 0 0 1 1h2v1H1.5a.5.5 0 0 0 0 1h5a.5.5 0 0 0 0-1H5zM1 2h6v9H1z"/>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        {{-- Utilizadores --}}
        <div class="col">
            <div class="card card-modern border-0 shadow-sm stat-card bg-white h-100">
                <div class="card-body p-3 d-flex align-items-center justify-content-between">
                    <div>
                        <span class="text-muted text-uppercase fw-semibold d-block" style="font-size: 0.68rem; letter-spacing: 0.5px;">Utilizadores</span>
                        <h3 class="fw-bold mb-0 mt-1" style="color: #0f2547;">{{ $totalUsers }}</h3>
                        <a href="{{ route('users.index') }}" class="stretched-link"></a>
                    </div>
                    <div class="icon-shape-navy">
                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-people-fill" viewBox="0 0 16 16">
                            <path d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6m-5.784 6A2.24 2.24 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.3 6.3 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1zM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5"/>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        {{-- Softwares --}}
        <div class="col">
            <div class="card card-modern border-0 shadow-sm stat-card bg-white h-100">
                <div class="card-body p-3 d-flex align-items-center justify-content-between">
                    <div>
                        <span class="text-muted text-uppercase fw-semibold d-block" style="font-size: 0.68rem; letter-spacing: 0.5px;">Softwares</span>
                        <h3 class="fw-bold mb-0 mt-1" style="color: #0f2547;">{{ $totalSoftwares }}</h3>
                        <a href="{{ route('softwares.index') }}" class="stretched-link"></a>
                    </div>
                    <div class="icon-shape-navy">
                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-disc-fill" viewBox="0 0 16 16">
                            <path d="M2.439 12.01a7 7 0 0 1 0-8.02l2.302 1.33a4.37 4.37 0 0 0 0 5.36zm.864 1.497 2.303-1.33a4.37 4.37 0 0 0 4.788 0l2.303 1.33a7 7 0 0 1-9.394 0M13.561 12.01l-2.302-1.33a4.37 4.37 0 0 0 0-5.36l2.302-1.33a7 7 0 0 1 0 8.02M12.697 2.493l-2.303 1.33a4.37 4.37 0 0 0-4.788 0L3.303 2.493a7 7 0 0 1 9.394 0M8 6a2 2 0 1 0 0 4 2 2 0 0 0 0-4"/>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        {{-- Instalações --}}
        <div class="col">
            <div class="card card-modern border-0 shadow-sm stat-card bg-white h-100">
                <div class="card-body p-3 d-flex align-items-center justify-content-between">
                    <div>
                        <span class="text-muted text-uppercase fw-semibold d-block" style="font-size: 0.68rem; letter-spacing: 0.5px;">Instalações</span>
                        <h3 class="fw-bold mb-0 mt-1" style="color: #0f2547;">{{ $totalInstallations }}</h3>
                        <a href="{{ route('installations.index') }}" class="stretched-link"></a>
                    </div>
                    <div class="icon-shape-navy">
                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-box-seam-fill" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M15.528 3.673a1 1 0 0 1 .472.847v7.96a1 1 0 0 1-.472.847l-7.385 4.22a1 1 0 0 1-.986 0L.472 13.327A1 1 0 0 1 0 12.48V4.52a1 1 0 0 1 .472-.847l7.385-4.22a1 1 0 0 1 .986 0zM8.5 1.579L2.175 5.192 8 8.52l5.825-3.328zM1 6.305v5.433l6.5 3.714V10.02zM15 6.305l-6.5 3.714v5.433l6.5-3.714z"/>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        {{-- Aposentações --}}
        <div class="col">
            <div class="card card-modern border-0 shadow-sm stat-card bg-white h-100">
                <div class="card-body p-3 d-flex align-items-center justify-content-between">
                    <div>
                        <span class="text-muted text-uppercase fw-semibold d-block" style="font-size: 0.68rem; letter-spacing: 0.5px;">Aposentações</span>
                        <h3 class="fw-bold mb-0 mt-1" style="color: #0f2547;">{{ $totalRetirements ?? 0 }}</h3>
                        <a href="{{ route('retirements.index') }}" class="stretched-link"></a>
                    </div>
                    <div class="icon-shape-navy">
                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-archive-fill" viewBox="0 0 16 16">
                            <path d="M12.643 15C13.979 15 15 13.845 15 12.5V5H1v7.5C1 13.845 2.021 15 3.357 15zM5.5 7h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1 0-1M.8 1a.8.8 0 0 0-.8.8V3a.8.8 0 0 0 .8.8h14.4A.8.8 0 0 0 16 3V1.8a.8.8 0 0 0-.8-.8z"/>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        {{-- Relatórios --}}
        <div class="col">
            <div class="card card-modern border-0 shadow-sm stat-card bg-white h-100">
                <div class="card-body p-3 d-flex align-items-center justify-content-between">
                    <div>
                        <span class="text-muted text-uppercase fw-semibold d-block" style="font-size: 0.68rem; letter-spacing: 0.5px;">Relatórios</span>
                        <h3 class="fw-bold mb-0 mt-1" style="color: #0f2547;">{{ $totalReports ?? 0 }}</h3>
                        <a href="{{ route('reports.index') }}" class="stretched-link"></a>
                    </div>
                    <div class="icon-shape-navy">
                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-file-earmark-bar-graph-fill" viewBox="0 0 16 16">
                            <path d="M9.293 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.707A1 1 0 0 0 13.707 4L10 .293A1 1 0 0 0 9.293 0M9.5 3.5v-2l3 3h-2a1 1 0 0 1-1-1m-7 9a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5m0-2a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5m0-2a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5"/>
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- CONTEÚDO PRINCIPAL --}}
    <div class="row g-4">
        {{-- Informações do Utilizador --}}
        <div class="col-lg-8">
            <div class="card card-modern shadow-sm border-0 bg-white h-100">
                <div class="card-header bg-navy-header py-3 px-4 d-flex align-items-center justify-content-between">
                    <h5 class="fw-bold mb-0 text-white">Informações do Utilizador</h5>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <tbody>
                                <tr>
                                    <th width="220" class="text-secondary fw-semibold bg-light bg-opacity-75">Nome</th>
                                    <td class="fw-bold" style="color: #0f2547;">{{ Auth::user()->name }}</td>
                                </tr>
                                <tr>
                                    <th class="text-secondary fw-semibold bg-light bg-opacity-75">Nº Crachá</th>
                                    <td><span class="badge border border-secondary text-dark px-2 py-1 fs-6">{{ Auth::user()->numero_cracha }}</span></td>
                                </tr>
                                <tr>
                                    <th class="text-secondary fw-semibold bg-light bg-opacity-75">Email</th>
                                    <td>{{ Auth::user()->email }}</td>
                                </tr>
                                <tr>
                                    <th class="text-secondary fw-semibold bg-light bg-opacity-75">Perfil</th>
                                    <td>
                                        <span class="badge badge-navy rounded-pill px-3 py-2 fw-bold" style="font-size: 0.75rem;">
                                            {{ strtoupper(Auth::user()->role) }}
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <th class="text-secondary fw-semibold bg-light bg-opacity-75">Estado</th>
                                    <td>
                                        @if(Auth::user()->ativo)
                                            <span class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25 rounded-pill px-3 py-2 fw-semibold" style="font-size: 0.75rem;">
                                                Ativo
                                            </span>
                                        @else
                                            <span class="badge bg-danger bg-opacity-10 text-danger border border-danger border-opacity-25 rounded-pill px-3 py-2 fw-semibold" style="font-size: 0.75rem;">
                                                Inativo
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        {{-- Resumo do Sistema --}}
        <div class="col-lg-4">
            <div class="card card-modern shadow-sm border-0 bg-white h-100">
                <div class="card-header bg-navy-header py-3 px-4">
                    <h5 class="fw-bold mb-0 text-white">Resumo do Sistema</h5>
                </div>
                <div class="card-body p-4">
                    <p class="text-secondary mb-3" style="font-size: 0.9rem; line-height: 1.6;">
                        Este painel apresenta um resumo das informações do <strong>Sistema de Gestão de Computadores (SinTech)</strong>.
                    </p>
                    <hr class="my-3 text-light">
                    <ul class="list-unstyled mb-0 d-flex flex-column gap-2">
                        @foreach(['Gestão de Computadores', 'Gestão de Utilizadores', 'Gestão de Softwares', 'Gestão de Instalações', 'Aposentações', 'Relatórios'] as $item)
                        <li class="d-flex align-items-center text-dark fw-medium py-1">
                            <span class="p-1 rounded-circle me-2 d-inline-flex align-items-center justify-content-center" style="width: 22px; height: 22px; background-color: rgba(15, 37, 71, 0.1); color: #0f2547;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" fill="currentColor" class="bi bi-check-lg" viewBox="0 0 16 16">
                                    <path d="M12.736 3.97a.733.733 0 0 1 1.047 0c.286.289.29.756.01 1.05L7.88 12.01a.733.733 0 0 1-1.065.02L3.217 8.384a.757.757 0 0 1 0-1.06.733.733 0 0 1 1.047 0l3.052 3.093 5.4-6.425z"/>
                                </svg>
                            </span>
                            {{ $item }}
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection