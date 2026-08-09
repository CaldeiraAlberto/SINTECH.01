<nav class="navbar navbar-expand-lg navbar-dark shadow-sm" style="background-color: #0a1b36; border-bottom: 1px solid rgba(255,255,255,0.08);">
    <div class="container-fluid px-4">
        <!-- Logo -->
        <a class="navbar-brand fw-bold d-flex align-items-center gap-2 text-white fs-5" href="{{ route('dashboard') }}">
            <i class="bi bi-pc-display fs-4 text-white"></i>
            <span>SinTech</span>
        </a>
        <!-- Botão Mobile -->
        <button class="navbar-toggler border-0"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarMenu">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarMenu">
            <ul class="navbar-nav align-items-center gap-2 mt-3 mt-lg-0">
                <!-- Perfil do Utilizador -->
                <li class="nav-item">
                    <span class="text-white d-flex align-items-center gap-2 fw-medium fs-6">
                        <i class="bi bi-person-circle fs-5 text-white-50"></i>
                        {{ Auth::user()->name }}
                    </span>
                </li>
                <li class="nav-item me-2">
    @if(Auth::user()->role == 'helpdesk')
        <span class="badge bg-warning text-dark fw-bold px-2 py-1"
              style="font-size: 0.7rem; letter-spacing: 0.5px;">
            HELP DESK
        </span>
    @else
        <span class="badge bg-success text-white fw-bold px-2 py-1"
              style="font-size: 0.7rem; letter-spacing: 0.5px;">
            RESPONSÁVEL
        </span>
    @endif
</li>
                <!-- Logout -->
                <li class="nav-item ms-lg-2">
                    <form action="{{ route('logout') }}" method="POST" class="m-0">
                        @csrf
                        <button type="submit" class="btn btn-outline-light btn-sm rounded-3 px-3 d-flex align-items-center gap-1.5 fw-semibold" style="font-size: 0.85rem;">
                            <i class="bi bi-box-arrow-right"></i>
                            <span>Sair</span>
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>