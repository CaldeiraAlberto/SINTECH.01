<!DOCTYPE html>
<html lang="pt">
<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="theme-color" content="#0f2547">

    <title>Entrar | SinTech</title>


    {{-- =========================================================
        FONTES
    ========================================================== --}}

    <link rel="preconnect" href="https://fonts.googleapis.com">

    <link rel="preconnect"
          href="https://fonts.gstatic.com"
          crossorigin>

    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Outfit:wght@500;600;700&display=swap"
        rel="stylesheet"
    >


    {{-- =========================================================
        BOOTSTRAP
    ========================================================== --}}

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >


    {{-- =========================================================
        BOOTSTRAP ICONS
    ========================================================== --}}

    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
    >


    <style>

        :root {
            --navy-dark: #08182f;
            --navy: #0f2547;
            --navy-light: #173966;

            --blue: #2563eb;
            --blue-light: #3b82f6;

            --text: #172033;
            --muted: #64748b;

            --border: #dbe3ee;

            --background: #f4f7fb;
        }


        * {
            box-sizing: border-box;
        }


        html,
        body {
            min-height: 100%;
        }


        body {

            margin: 0;

            font-family: 'Inter', sans-serif;

            background:
                radial-gradient(
                    circle at 10% 10%,
                    rgba(59, 130, 246, 0.18),
                    transparent 32%
                ),
                radial-gradient(
                    circle at 90% 90%,
                    rgba(37, 99, 235, 0.12),
                    transparent 35%
                ),
                linear-gradient(
                    135deg,
                    #061225 0%,
                    #0b1d38 48%,
                    #102d52 100%
                );

            min-height: 100vh;

            display: flex;

            align-items: center;

            justify-content: center;

            padding: 25px 15px;

            position: relative;

            overflow-x: hidden;
        }


        /* =========================================================
           ELEMENTOS DECORATIVOS
        ========================================================== */

        body::before {

            content: "";

            position: fixed;

            width: 380px;

            height: 380px;

            border-radius: 50%;

            background: rgba(59, 130, 246, 0.08);

            top: -170px;

            left: -170px;

            filter: blur(5px);

            pointer-events: none;
        }


        body::after {

            content: "";

            position: fixed;

            width: 320px;

            height: 320px;

            border-radius: 50%;

            background: rgba(14, 165, 233, 0.06);

            right: -140px;

            bottom: -140px;

            pointer-events: none;
        }


        /* =========================================================
           CONTAINER
        ========================================================== */

        .login-wrapper {

            width: 100%;

            max-width: 380px;

            position: relative;

            z-index: 2;
        }


        /* =========================================================
           CARTÃO
        ========================================================== */

        .login-card {

            background: #ffffff;

            border: 1px solid rgba(255,255,255,0.5);

            border-radius: 16px;

            overflow: hidden;

            box-shadow:
                0 25px 60px rgba(0, 0, 0, 0.30),
                0 8px 20px rgba(0, 0, 0, 0.12);
        }


        /* =========================================================
           CABEÇALHO
        ========================================================== */

        .login-header {

            position: relative;

            padding: 26px 22px 24px;

            text-align: center;

            color: #ffffff;

            background:
                linear-gradient(
                    145deg,
                    #0a1b36 0%,
                    #0f2547 55%,
                    #183866 100%
                );

            overflow: hidden;
        }


        .login-header::before {

            content: "";

            position: absolute;

            width: 160px;

            height: 160px;

            border-radius: 50%;

            border: 1px solid rgba(255,255,255,0.08);

            top: -90px;

            right: -55px;
        }


        .login-header::after {

            content: "";

            position: absolute;

            width: 120px;

            height: 120px;

            border-radius: 50%;

            border: 1px solid rgba(255,255,255,0.06);

            bottom: -70px;

            left: -35px;
        }


        /* =========================================================
           ÍCONE DA MARCA
        ========================================================== */

        .brand-icon {

            width: 58px;

            height: 58px;

            margin: 0 auto 12px;

            display: flex;

            align-items: center;

            justify-content: center;

            border-radius: 14px;

            background: rgba(255,255,255,0.10);

            border: 1px solid rgba(255,255,255,0.18);

            box-shadow:
                0 8px 22px rgba(0,0,0,0.20);

            position: relative;

            z-index: 2;
        }


        .brand-icon i {

            font-size: 28px;
        }


        .brand-name {

            font-family: 'Outfit', sans-serif;

            font-size: 1.7rem;

            font-weight: 700;

            letter-spacing: -0.02em;

            margin: 0;

            position: relative;

            z-index: 2;
        }


        .brand-subtitle {

            margin-top: 5px;

            font-size: 0.72rem;

            line-height: 1.4;

            color: rgba(255,255,255,0.68);

            letter-spacing: 0.03em;

            position: relative;

            z-index: 2;
        }


        /* =========================================================
           CORPO
        ========================================================== */

        .login-body {

            padding: 26px;
        }


        .welcome-title {

            font-family: 'Outfit', sans-serif;

            font-size: 1.35rem;

            font-weight: 700;

            color: var(--text);

            margin-bottom: 4px;
        }


        .welcome-text {

            color: var(--muted);

            font-size: 0.82rem;

            margin-bottom: 22px;
        }


        /* =========================================================
           ALERTAS
        ========================================================== */

        .login-alert {

            border-radius: 9px;

            border: none;

            font-size: 0.78rem;

            margin-bottom: 18px;
        }


        /* =========================================================
           LABELS
        ========================================================== */

        .form-label {

            color: #334155;

            font-size: 0.78rem;

            font-weight: 600;

            margin-bottom: 6px;
        }


        /* =========================================================
           INPUT
        ========================================================== */

        .input-wrapper {

            position: relative;
        }


        .input-icon {

            position: absolute;

            left: 13px;

            top: 50%;

            transform: translateY(-50%);

            color: #94a3b8;

            font-size: 0.95rem;

            z-index: 3;

            pointer-events: none;
        }


        .form-control-modern {

            width: 100%;

            height: 45px;

            padding: 0 43px;

            border: 1px solid var(--border);

            border-radius: 9px;

            background: #f8fafc;

            color: var(--text);

            font-size: 0.84rem;

            transition:
                border-color 0.2s ease,
                box-shadow 0.2s ease,
                background 0.2s ease;
        }


        .form-control-modern::placeholder {

            color: #9aa8ba;
        }


        .form-control-modern:hover {

            border-color: #b8c5d6;

            background: #ffffff;
        }


        .form-control-modern:focus {

            outline: none;

            border-color: var(--blue);

            background: #ffffff;

            box-shadow:
                0 0 0 3px rgba(37, 99, 235, 0.12);
        }


        /* =========================================================
           PASSWORD
        ========================================================== */

        .password-wrapper .form-control-modern {

            padding-right: 48px;
        }


        .password-toggle {

            position: absolute;

            right: 4px;

            top: 4px;

            width: 37px;

            height: 37px;

            border: none;

            border-radius: 8px;

            background: transparent;

            color: #64748b;

            display: flex;

            align-items: center;

            justify-content: center;

            cursor: pointer;

            transition: all 0.2s ease;

            z-index: 4;
        }


        .password-toggle:hover {

            color: var(--navy);

            background: #edf2f7;
        }


        /* =========================================================
           RECUPERAÇÃO
        ========================================================== */

        .forgot-password {

            color: var(--blue);

            font-size: 0.74rem;

            font-weight: 600;

            text-decoration: none;

            transition: color 0.2s ease;
        }


        .forgot-password:hover {

            color: #1d4ed8;

            text-decoration: underline;
        }


        /* =========================================================
           BOTÃO LOGIN
        ========================================================== */

        .btn-login {

            height: 45px;

            border: none;

            border-radius: 9px;

            background:
                linear-gradient(
                    135deg,
                    #0f2547,
                    #1d4f91
                );

            color: #ffffff;

            font-size: 0.84rem;

            font-weight: 600;

            letter-spacing: 0.01em;

            transition: all 0.25s ease;

            box-shadow:
                0 6px 14px rgba(15,37,71,0.20);
        }


        .btn-login:hover {

            color: #ffffff;

            transform: translateY(-1px);

            background:
                linear-gradient(
                    135deg,
                    #122d54,
                    #2563a6
                );

            box-shadow:
                0 9px 20px rgba(15,37,71,0.27);
        }


        .btn-login:active {

            transform: translateY(0);
        }


        .btn-login.loading {

            pointer-events: none;

            opacity: 0.85;
        }


        /* =========================================================
           RODAPÉ
        ========================================================== */

        .login-footer {

            margin-top: 20px;

            padding-top: 15px;

            border-top: 1px solid #edf1f5;

            text-align: center;

            color: #94a3b8;

            font-size: 0.68rem;
        }


        .security-info {

            display: inline-flex;

            align-items: center;

            gap: 6px;
        }


        .security-info i {

            color: #16a34a;
        }


        /* =========================================================
           RESPONSIVO
        ========================================================== */

        @media (max-width: 480px) {

            body {

                padding: 15px;
            }


            .login-wrapper {

                max-width: 100%;
            }


            .login-card {

                border-radius: 14px;
            }


            .login-header {

                padding: 24px 18px 22px;
            }


            .login-body {

                padding: 22px 20px;
            }


            .brand-icon {

                width: 54px;

                height: 54px;
            }


            .brand-icon i {

                font-size: 26px;
            }


            .brand-name {

                font-size: 1.55rem;
            }
        }


        /* =========================================================
           ACESSIBILIDADE
        ========================================================== */

        @media (prefers-reduced-motion: reduce) {

            *,
            *::before,
            *::after {

                transition: none !important;
            }
        }

    </style>

</head>


<body>


<div class="login-wrapper">

    <div class="login-card">


        {{-- =====================================================
             CABEÇALHO
        ====================================================== --}}

        <div class="login-header">

            <div class="brand-icon">

                <i class="bi bi-pc-display"></i>

            </div>


            <h1 class="brand-name">
                SinTech
            </h1>


            <div class="brand-subtitle">
                Sistema de Gestão de Computadores e Softwares
            </div>

        </div>


        {{-- =====================================================
             CORPO
        ====================================================== --}}

        <div class="login-body">


            <div class="welcome-title">
                Bem-vindo
            </div>


            <p class="welcome-text">
                Entre na sua conta para aceder ao sistema.
            </p>


            {{-- =================================================
                 ERRO DE LOGIN
            ================================================== --}}

            @if(session('error'))

                <div
                    class="alert alert-danger login-alert d-flex align-items-center"
                    role="alert">

                    <i class="bi bi-exclamation-triangle-fill me-2"></i>

                    <span>
                        {{ session('error') }}
                    </span>

                </div>

            @endif


            {{-- =================================================
                 ERROS DE VALIDAÇÃO
            ================================================== --}}

            @if($errors->any())

                <div
                    class="alert alert-danger login-alert"
                    role="alert">

                    <div class="d-flex align-items-center mb-2">

                        <i class="bi bi-exclamation-circle-fill me-2"></i>

                        <strong>
                            Verifique os dados introduzidos.
                        </strong>

                    </div>


                    <ul class="mb-0 ps-4">

                        @foreach($errors->all() as $error)

                            <li>
                                {{ $error }}
                            </li>

                        @endforeach

                    </ul>

                </div>

            @endif


            {{-- =================================================
                 FORMULÁRIO
            ================================================== --}}

            <form
                method="POST"
                action="{{ route('login.store') }}"
                id="loginForm">

                @csrf


                {{-- EMAIL --}}

                <div class="mb-3">

                    <label
                        for="email"
                        class="form-label">

                        Email

                    </label>


                    <div class="input-wrapper">

                        <i class="bi bi-envelope input-icon"></i>


                        <input
                            type="email"
                            id="email"
                            name="email"
                            class="form-control-modern @error('email') is-invalid @enderror"
                            value="{{ old('email') }}"
                            placeholder="exemplo@sintech.com"
                            autocomplete="email"
                            required
                            autofocus>

                    </div>


                    @error('email')

                        <div class="text-danger small mt-1">
                            {{ $message }}
                        </div>

                    @enderror

                </div>


                {{-- PASSWORD --}}

                <div class="mb-2">

                    <div class="d-flex justify-content-between align-items-center">

                        <label
                            for="password"
                            class="form-label">

                            Palavra-passe

                        </label>


                        <a
                            href="#"
                            class="forgot-password"
                            data-bs-toggle="modal"
                            data-bs-target="#forgotPasswordModal">

                            Esqueci a palavra-passe

                        </a>

                    </div>


                    <div class="input-wrapper password-wrapper">

                        <i class="bi bi-lock input-icon"></i>


                        <input
                            type="password"
                            id="password"
                            name="password"
                            class="form-control-modern @error('password') is-invalid @enderror"
                            placeholder="Digite a sua palavra-passe"
                            autocomplete="current-password"
                            required>


                        {{-- OLHO --}}

                        <button
                            type="button"
                            class="password-toggle"
                            id="togglePassword"
                            title="Mostrar palavra-passe"
                            aria-label="Mostrar palavra-passe">

                            <i
                                class="bi bi-eye"
                                id="passwordIcon">
                            </i>

                        </button>

                    </div>


                    @error('password')

                        <div class="text-danger small mt-1">
                            {{ $message }}
                        </div>

                    @enderror

                </div>


                {{-- BOTÃO ENTRAR --}}

                <div class="d-grid mt-3">

                    <button
                        type="submit"
                        class="btn btn-login"
                        id="loginButton">

                        <span id="loginButtonContent">

                            <i class="bi bi-box-arrow-in-right me-2"></i>

                            Entrar no sistema

                        </span>

                    </button>

                </div>


            </form>


            {{-- =================================================
                 RODAPÉ
            ================================================== --}}

            <div class="login-footer">

                <div class="security-info">

                    <i class="bi bi-shield-check"></i>

                    <span>
                        Acesso protegido pelo SinTech
                    </span>

                </div>

            </div>


        </div>

    </div>

</div>


{{-- =========================================================
     MODAL RECUPERAÇÃO
========================================================= --}}

<div
    class="modal fade"
    id="forgotPasswordModal"
    tabindex="-1"
    aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content border-0 shadow-lg">

            <div class="modal-header">

                <h5 class="modal-title fw-bold">

                    <i class="bi bi-key me-2"></i>

                    Recuperar palavra-passe

                </h5>


                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Fechar">
                </button>

            </div>


            <div class="modal-body">

                <p class="text-muted mb-0">

                    A recuperação automática da palavra-passe
                    ainda não está disponível.

                    <br><br>

                    Contacte o responsável pelo Help Desk
                    para efectuar a reposição da sua palavra-passe.

                </p>

            </div>


            <div class="modal-footer">

                <button
                    type="button"
                    class="btn btn-secondary"
                    data-bs-dismiss="modal">

                    Fechar

                </button>

            </div>

        </div>

    </div>

</div>


{{-- =========================================================
     BOOTSTRAP JS
========================================================= --}}

<script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js">
</script>


<script>

    /* =========================================================
       MOSTRAR / OCULTAR PALAVRA-PASSE
    ========================================================== */

    const togglePassword =
        document.getElementById('togglePassword');

    const password =
        document.getElementById('password');

    const passwordIcon =
        document.getElementById('passwordIcon');


    togglePassword.addEventListener('click', function () {

        const isPassword =
            password.type === 'password';


        password.type =
            isPassword ? 'text' : 'password';


        if (isPassword) {

            passwordIcon.classList.remove('bi-eye');

            passwordIcon.classList.add('bi-eye-slash');


            togglePassword.setAttribute(
                'title',
                'Ocultar palavra-passe'
            );


            togglePassword.setAttribute(
                'aria-label',
                'Ocultar palavra-passe'
            );

        } else {

            passwordIcon.classList.remove('bi-eye-slash');

            passwordIcon.classList.add('bi-eye');


            togglePassword.setAttribute(
                'title',
                'Mostrar palavra-passe'
            );


            togglePassword.setAttribute(
                'aria-label',
                'Mostrar palavra-passe'
            );
        }

    });


    /* =========================================================
       ESTADO DE CARREGAMENTO
    ========================================================== */

    const loginForm =
        document.getElementById('loginForm');

    const loginButton =
        document.getElementById('loginButton');

    const loginButtonContent =
        document.getElementById('loginButtonContent');


    loginForm.addEventListener('submit', function () {

        loginButton.classList.add('loading');


        loginButtonContent.innerHTML = `
            <span
                class="spinner-border spinner-border-sm me-2"
                role="status"
                aria-hidden="true">
            </span>

            A entrar...
        `;

    });

</script>


</body>
</html>