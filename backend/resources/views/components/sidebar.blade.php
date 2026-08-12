<aside id="sidebar" class="col-md-3 col-lg-2 p-0 text-white min-vh-100 shadow-sm" style="background-color: #0f2547;">
    <style>
        .sidebar-heading {
            font-size: 0.7rem;
            letter-spacing: 1px;
            font-weight: 700;
            color: rgba(255, 255, 255, 0.6);
            background-color: rgba(0, 0, 0, 0.15);
            padding: 0.75rem 1.25rem;
            text-transform: uppercase;
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
            border-top: 1px solid rgba(255, 255, 255, 0.05);
        }
        .sidebar-link {
            color: rgba(255, 255, 255, 0.75) !important;
            padding: 0.75rem 1.25rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            text-decoration: none;
            font-weight: 500;
            font-size: 0.9rem;
            transition: all 0.2s ease;
            border-left: 3px solid transparent;
        }
        .sidebar-link:hover {
            color: #ffffff !important;
            background-color: rgba(255, 255, 255, 0.08);
            border-left-color: rgba(255, 255, 255, 0.5);
        }
        .sidebar-link.active {
            color: #ffffff !important;
            font-weight: 700;
            background-color: rgba(255, 255, 255, 0.15);
            border-left-color: #ffffff;
        }
    </style>

    <div class="d-flex flex-column h-100 min-vh-100">
        {{-- NAVEGAÇÃO PRINCIPAL --}}
        <div class="flex-grow-1">
            <div class="sidebar-heading border-top-0">
                MENU PRINCIPAL
            </div>

            <nav class="nav flex-column">
                {{-- Dashboard --}}
                <a href="{{ route('dashboard') }}"
                   class="sidebar-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <i class="bi bi-speedometer2 fs-5"></i>
                    <span>Dashboard</span>
                </a>

                {{-- ========================================= --}}
                {{-- ADMINISTRAÇÃO - HELP DESK --}}
                {{-- ========================================= --}}
                @if(Auth::user()->role === 'helpdesk')
                    <div class="sidebar-heading mt-2">
                        ADMINISTRAÇÃO
                    </div>

                    {{-- Utilizadores --}}
                    <a href="{{ route('users.index') }}"
                       class="sidebar-link {{ request()->routeIs('users.*') ? 'active' : '' }}">
                        <i class="bi bi-people-fill fs-5"></i>
                        <span>Utilizadores</span>
                    </a>

                    {{-- Computadores --}}
                    <a href="{{ route('computers.index') }}"
                       class="sidebar-link {{ request()->routeIs('computers.*') ? 'active' : '' }}">
                        <i class="bi bi-pc-display fs-5"></i>
                        <span>Computadores</span>
                    </a>

                    {{-- Softwares --}}
                    <a href="{{ route('softwares.index') }}"
                       class="sidebar-link {{ request()->routeIs('softwares.*') ? 'active' : '' }}">
                        <i class="bi bi-disc-fill fs-5"></i>
                        <span>Softwares</span>
                    </a>

                    {{-- Instalações --}}
                    <a href="{{ route('installations.index') }}"
                       class="sidebar-link {{ request()->routeIs('installations.*') ? 'active' : '' }}">
                        <i class="bi bi-box-seam-fill fs-5"></i>
                        <span>Instalações</span>
                    </a>

                    {{-- Aposentações --}}
                    <a href="{{ route('retirements.index') }}"
                       class="sidebar-link {{ request()->routeIs('retirements.*') ? 'active' : '' }}">
                        <i class="bi bi-archive-fill fs-5"></i>
                        <span>Aposentações</span>
                    </a>

                    {{-- Relatórios --}}
                    <a href="{{ route('reports.index') }}"
                       class="sidebar-link {{ request()->routeIs('reports.*') ? 'active' : '' }}">
                        <i class="bi bi-file-earmark-bar-graph-fill fs-5"></i>
                        <span>Relatórios</span>
                    </a>
                @endif

                {{-- ========================================= --}}
                {{-- CONSULTA - RESPONSÁVEL --}}
                {{-- ========================================= --}}
                @if(Auth::user()->role === 'responsavel')
                    <div class="sidebar-heading mt-2">
                        CONSULTA
                    </div>

                    {{-- Meus Softwares --}}
                    <a href="{{ route('responsavel.softwares') }}"
                       class="sidebar-link {{ request()->routeIs('responsavel.softwares') ? 'active' : '' }}">
                        <i class="bi bi-disc-fill fs-5"></i>
                        <span>Meus Softwares</span>
                    </a>
                @endif
            </nav>
        </div>
    </div>
</aside>