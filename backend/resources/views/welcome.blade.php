<!DOCTYPE html>
<html lang="pt">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0">

    <meta
        name="description"
        content="SinTech - Sistema académico do 6.º Grupo, Mestrado em Sistemas de Informação">

    <title>
        SinTech | Sistema Académico do 6.º Grupo
    </title>


    {{-- ========================================================= --}}
    {{-- FONTES --}}
    {{-- ========================================================= --}}

    <link
        rel="preconnect"
        href="https://fonts.googleapis.com">

    <link
        rel="preconnect"
        href="https://fonts.gstatic.com"
        crossorigin>

    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Outfit:wght@600;700;800&display=swap"
        rel="stylesheet">


    {{-- ========================================================= --}}
    {{-- BOOTSTRAP --}}
    {{-- ========================================================= --}}

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet">

    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">


    {{-- ========================================================= --}}
    {{-- ESTILOS --}}
    {{-- ========================================================= --}}

    <style>

        :root {

            --navy-dark: #07162d;

            --navy: #0f2547;

            --navy-light: #163869;

            --blue-accent: #2563eb;

            --blue-hover: #1d4ed8;

            --text-dark: #0f172a;

            --text-muted: #64748b;

            --border: #e2e8f0;

            --white: #ffffff;

            --light-bg: #f8fafc;

        }


        * {
            box-sizing: border-box;
        }


        html {
            scroll-behavior: smooth;
        }


        body {

            font-family: 'Inter', sans-serif;

            color: var(--text-dark);

            background: var(--white);

            overflow-x: hidden;

        }


        h1,
        h2,
        h3,
        h4,
        h5,
        h6,
        .brand {

            font-family: 'Outfit', 'Inter', sans-serif;

        }


        /* ========================================================= */
        /* NAVBAR */
        /* ========================================================= */

        .navbar-custom {

            background: rgba(15, 37, 71, 0.97);

            backdrop-filter: blur(16px);

            border-bottom: 1px solid rgba(255,255,255,0.1);

            padding: 1rem 0;

        }


        .brand {

            display: flex;

            align-items: center;

            gap: .75rem;

            color: var(--white);

            text-decoration: none;

            font-weight: 800;

            font-size: 1.35rem;

            letter-spacing: -.5px;

        }


        .brand-icon {

            width: 44px;

            height: 44px;

            border-radius: .75rem;

            background:
                linear-gradient(
                    135deg,
                    rgba(255,255,255,.2),
                    rgba(255,255,255,.05)
                );

            border: 1px solid rgba(255,255,255,.25);

            display: flex;

            align-items: center;

            justify-content: center;

            color: var(--white);

            box-shadow:
                0 4px 15px rgba(0,0,0,.15);

        }


        .navbar-custom .nav-link {

            color: rgba(255,255,255,.8);

            font-size: .95rem;

            font-weight: 500;

            margin-left: 1.25rem;

            transition: all .2s ease;

        }


        .navbar-custom .nav-link:hover {

            color: var(--white);

            transform: translateY(-1px);

        }


        .btn-login-nav {

            background: var(--white);

            color: var(--navy);

            border: none;

            border-radius: .75rem;

            padding: .6rem 1.3rem;

            font-size: .9rem;

            font-weight: 700;

            transition: all .25s ease;

            box-shadow:
                0 4px 12px rgba(0,0,0,.1);

        }


        .btn-login-nav:hover {

            background: #f1f5f9;

            color: var(--navy-light);

            transform: translateY(-2px);

            box-shadow:
                0 6px 18px rgba(0,0,0,.15);

        }


        /* ========================================================= */
        /* HERO */
        /* ========================================================= */

        .hero {

            position: relative;

            background:
                radial-gradient(
                    circle at 85% 15%,
                    rgba(37,99,235,.25),
                    transparent 45%
                ),
                linear-gradient(
                    135deg,
                    var(--navy-dark) 0%,
                    var(--navy) 60%,
                    var(--navy-light) 100%
                );

            color: var(--white);

            padding: 8rem 0 6rem;

            overflow: hidden;

        }


        .hero-badge {

            display: inline-flex;

            align-items: center;

            gap: .6rem;

            padding: .5rem 1rem;

            border-radius: 2rem;

            background: rgba(255,255,255,.1);

            border: 1px solid rgba(255,255,255,.18);

            color: #93c5fd;

            font-size: .8rem;

            font-weight: 700;

            letter-spacing: .5px;

            margin-bottom: 1.5rem;

        }


        .hero h1 {

            font-size: clamp(
                2.3rem,
                5.5vw,
                4.2rem
            );

            line-height: 1.1;

            font-weight: 800;

            letter-spacing: -1.5px;

            margin-bottom: 1.5rem;

        }


        .hero h1 span {

            background:
                linear-gradient(
                    135deg,
                    #ffffff 0%,
                    #93c5fd 100%
                );

            -webkit-background-clip: text;

            -webkit-text-fill-color: transparent;

        }


        .hero-description {

            max-width: 650px;

            color: rgba(255,255,255,.82);

            font-size: 1.08rem;

            line-height: 1.8;

            margin-bottom: 2.2rem;

        }


        .hero-description strong {

            color: #ffffff;

        }


        .hero-buttons {

            display: flex;

            flex-wrap: wrap;

            gap: 1rem;

        }


        .btn-hero-primary {

            background: var(--blue-accent);

            color: var(--white);

            border: none;

            border-radius: .75rem;

            padding: .85rem 1.6rem;

            font-weight: 700;

            font-size: .95rem;

            text-decoration: none;

            transition: all .25s ease;

            box-shadow:
                0 8px 20px rgba(37,99,235,.35);

        }


        .btn-hero-primary:hover {

            background: var(--blue-hover);

            color: var(--white);

            transform: translateY(-2px);

            box-shadow:
                0 12px 25px rgba(37,99,235,.45);

        }


        .btn-hero-outline {

            background: rgba(255,255,255,.08);

            color: var(--white);

            border: 1px solid rgba(255,255,255,.25);

            border-radius: .75rem;

            padding: .85rem 1.6rem;

            font-weight: 600;

            font-size: .95rem;

            text-decoration: none;

            transition: all .25s ease;

        }


        .btn-hero-outline:hover {

            background: rgba(255,255,255,.15);

            color: var(--white);

            border-color: rgba(255,255,255,.4);

            transform: translateY(-2px);

        }


        /* ========================================================= */
        /* CARTÃO ACADÉMICO */
        /* ========================================================= */

        .hero-card {

            background: rgba(255,255,255,.08);

            border: 1px solid rgba(255,255,255,.16);

            border-radius: 1.25rem;

            padding: 1.75rem;

            backdrop-filter: blur(16px);

            box-shadow:
                0 30px 60px rgba(0,0,0,.3);

        }


        .hero-card-header {

            display: flex;

            align-items: center;

            gap: 1rem;

            padding-bottom: 1.25rem;

            border-bottom:
                1px solid rgba(255,255,255,.12);

        }


        .hero-card-icon {

            width: 52px;

            height: 52px;

            border-radius: .85rem;

            background:
                rgba(37,99,235,.25);

            border:
                1px solid rgba(255,255,255,.2);

            display: flex;

            align-items: center;

            justify-content: center;

            font-size: 1.5rem;

            color: #93c5fd;

        }


        .hero-stat-row {

            display: flex;

            align-items: center;

            justify-content: space-between;

            gap: 1rem;

            padding: 1rem 0;

            border-bottom:
                1px solid rgba(255,255,255,.08);

        }


        .hero-stat-row:last-child {

            border-bottom: none;

        }


        /* ========================================================= */
        /* SEÇÕES */
        /* ========================================================= */

        .section {

            padding: 6rem 0;

        }


        .section-light {

            background: var(--light-bg);

        }


        .section-title {

            text-align: center;

            max-width: 750px;

            margin: 0 auto 3.5rem;

        }


        .section-title .badge-tag {

            color: var(--blue-accent);

            font-size: .8rem;

            font-weight: 800;

            letter-spacing: 1.5px;

            text-transform: uppercase;

            margin-bottom: .8rem;

            display: inline-block;

        }


        .section-title h2 {

            font-weight: 800;

            font-size: 2.2rem;

            letter-spacing: -.8px;

            margin-bottom: 1rem;

        }


        .section-title p {

            color: var(--text-muted);

            font-size: 1rem;

            line-height: 1.7;

        }


        /* ========================================================= */
        /* CARDS */
        /* ========================================================= */

        .about-card {

            background: var(--white);

            border: 1px solid var(--border);

            border-radius: 1.25rem;

            padding: 2.25rem;

            height: 100%;

            transition: all .3s ease;

            box-shadow:
                0 10px 30px rgba(15,37,71,.04);

        }


        .about-card:hover {

            transform: translateY(-4px);

            border-color: #cbd5e1;

            box-shadow:
                0 15px 35px rgba(15,37,71,.08);

        }


        .about-icon-box {

            width: 54px;

            height: 54px;

            border-radius: .85rem;

            background: #eff6ff;

            color: var(--blue-accent);

            display: flex;

            align-items: center;

            justify-content: center;

            font-size: 1.5rem;

            margin-bottom: 1.25rem;

        }


        .feature-card {

            background: var(--white);

            border: 1px solid var(--border);

            border-radius: 1.25rem;

            padding: 1.75rem;

            height: 100%;

            transition: all .3s ease;

        }


        .feature-card:hover {

            transform: translateY(-6px);

            border-color: var(--blue-accent);

            box-shadow:
                0 20px 40px rgba(15,37,71,.08);

        }


        .feature-num {

            font-size: .8rem;

            font-weight: 800;

            color: var(--blue-accent);

            background: #eff6ff;

            padding: .3rem .6rem;

            border-radius: .5rem;

            display: inline-block;

            margin-bottom: 1.25rem;

        }


        .feature-card h5 {

            font-size: 1.1rem;

            font-weight: 700;

            margin-bottom: .75rem;

        }


        .feature-card p {

            color: var(--text-muted);

            font-size: .9rem;

            line-height: 1.65;

            margin: 0;

        }


        /* ========================================================= */
        /* FLUXO */
        /* ========================================================= */

        .process-step {

            text-align: center;

            padding: 1rem;

        }


        .process-circle {

            width: 64px;

            height: 64px;

            border-radius: 50%;

            background: var(--navy);

            color: var(--white);

            font-size: 1.2rem;

            font-weight: 800;

            display: flex;

            align-items: center;

            justify-content: center;

            margin: 0 auto 1.25rem;

            box-shadow:
                0 10px 25px rgba(15,37,71,.25);

            border: 3px solid #eff6ff;

        }


        /* ========================================================= */
        /* EQUIPA */
        /* ========================================================= */

        .team-card {

            background: var(--white);

            border: 1px solid var(--border);

            border-radius: 1.25rem;

            padding: 2rem 1rem;

            text-align: center;

            height: 100%;

            transition: all .3s ease;

        }


        .team-card:hover {

            transform: translateY(-5px);

            box-shadow:
                0 15px 30px rgba(15,37,71,.08);

            border-color: #cbd5e1;

        }


        .team-avatar {

            width: 68px;

            height: 68px;

            border-radius: 50%;

            background:
                linear-gradient(
                    135deg,
                    var(--navy),
                    var(--blue-accent)
                );

            color: var(--white);

            font-size: 1rem;

            font-weight: 800;

            display: flex;

            align-items: center;

            justify-content: center;

            margin: 0 auto 1rem;

            box-shadow:
                0 8px 20px rgba(15,37,71,.2);

        }


        /* ========================================================= */
        /* CTA */
        /* ========================================================= */

        .cta-section {

            background:
                linear-gradient(
                    135deg,
                    var(--navy-dark) 0%,
                    var(--navy) 100%
                );

            color: var(--white);

            padding: 5.5rem 0;

            text-align: center;

        }


        .cta-box {

            max-width: 720px;

            margin: 0 auto;

        }


        /* ========================================================= */
        /* FOOTER */
        /* ========================================================= */

        .footer {

            background: #040e1d;

            color: rgba(255,255,255,.6);

            padding: 2.25rem 0;

            font-size: .85rem;

            border-top:
                1px solid rgba(255,255,255,.08);

        }


        /* ========================================================= */
        /* RESPONSIVIDADE */
        /* ========================================================= */

        @media (max-width: 991.98px) {

            .hero {

                padding: 6rem 0 4rem;

                text-align: center;

            }


            .hero-description {

                margin-left: auto;

                margin-right: auto;

            }


            .hero-buttons {

                justify-content: center;

            }


            .hero-card {

                margin-top: 3.5rem;

            }

        }


        @media (max-width: 575.98px) {

            .section {

                padding: 4rem 0;

            }


            .hero h1 {

                font-size: 2.2rem;

            }


            .hero-buttons {

                flex-direction: column;

            }


            .btn-hero-primary,
            .btn-hero-outline {

                width: 100%;

                text-align: center;

                justify-content: center;

            }


            .hero-stat-row {

                flex-direction: column;

                align-items: flex-start;

            }

        }

    </style>

</head>


<body>


{{-- ============================================================= --}}
{{-- NAVBAR --}}
{{-- ============================================================= --}}

<nav class="navbar navbar-expand-lg navbar-custom sticky-top">

    <div class="container">


        <a
            href="{{ route('home') }}"
            class="brand">

            <span class="brand-icon">

                <i class="bi bi-cpu-fill"></i>

            </span>

            <span>
                SinTech
            </span>

        </a>


        <button
            class="navbar-toggler border-0 text-white shadow-none"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#mainNavbar"
            aria-controls="mainNavbar"
            aria-expanded="false"
            aria-label="Abrir menu">

            <i class="bi bi-list fs-2"></i>

        </button>


        <div
            class="collapse navbar-collapse"
            id="mainNavbar">

            <ul class="navbar-nav ms-auto align-items-lg-center">


                <li class="nav-item">

                    <a
                        class="nav-link"
                        href="#sobre">

                        Sobre o Sistema

                    </a>

                </li>


                <li class="nav-item">

                    <a
                        class="nav-link"
                        href="#funcionalidades">

                        Funcionalidades

                    </a>

                </li>


                <li class="nav-item">

                    <a
                        class="nav-link"
                        href="#fluxo">

                        Funcionamento

                    </a>

                </li>


                <li class="nav-item">

                    <a
                        class="nav-link"
                        href="#grupo">

                        Grupo

                    </a>

                </li>


                <li class="nav-item ms-lg-3 mt-3 mt-lg-0">

                    <a
                        href="{{ route('login') }}"
                        class="btn btn-login-nav d-inline-flex align-items-center gap-2">

                        <i class="bi bi-box-arrow-in-right"></i>

                        <span>
                            Aceder ao Sistema
                        </span>

                    </a>

                </li>

            </ul>

        </div>

    </div>

</nav>



{{-- ============================================================= --}}
{{-- HERO / APRESENTAÇÃO DO SISTEMA --}}
{{-- ============================================================= --}}

<section class="hero">

    <div class="container">

        <div class="row align-items-center">


            {{-- TEXTO PRINCIPAL --}}

            <div class="col-lg-7">


                <div class="hero-badge">

                    <i class="bi bi-mortarboard-fill"></i>

                    <span>
                        SISTEMA ACADÉMICO • 6.º GRUPO
                    </span>

                </div>


                <h1>

                    Sistema de Gestão de

                    <span>
                        Computadores e Softwares
                    </span>

                </h1>


                <p class="hero-description">

                    Sistema académico desenvolvido no âmbito do módulo de
                    <strong>
                        Desenvolvimento de Sistemas de Informação
                        e Web Semântica
                    </strong>,
                    como requisito de avaliação do
                    <strong>
                        Curso de Mestrado em Sistemas de Informação
                    </strong>,
                    submetido à <strong>Academia Militar</strong>.

                </p>


                <div class="hero-buttons">


                    <a
                        href="{{ route('login') }}"
                        class="btn-hero-primary d-inline-flex align-items-center gap-2">

                        <i class="bi bi-box-arrow-in-right"></i>

                        <span>
                            Aceder ao Sistema
                        </span>

                    </a>


                    <a
                        href="#grupo"
                        class="btn-hero-outline d-inline-flex align-items-center gap-2">

                        <span>
                            Conhecer o Grupo
                        </span>

                        <i class="bi bi-arrow-down"></i>

                    </a>


                </div>

            </div>


            {{-- CARTÃO ACADÉMICO --}}

            <div class="col-lg-5">

                <div class="hero-card">


                    <div class="hero-card-header">


                        <div class="hero-card-icon">

                            <i class="bi bi-mortarboard-fill"></i>

                        </div>


                        <div>

                            <h5 class="fw-bold mb-0 text-white">

                                Sistema Académico do 6.º Grupo

                            </h5>

                            <small class="text-white-50">

                                Mestrado em Sistemas de Informação

                            </small>

                        </div>


                    </div>


                    <div class="hero-stat-row">

                        <span class="text-white-50 small">
                            Instituição
                        </span>

                        <span class="fw-bold text-white">

                            <i class="bi bi-building me-1 text-info"></i>

                            Academia Militar

                        </span>

                    </div>


                    <div class="hero-stat-row">

                        <span class="text-white-50 small">
                            Módulo
                        </span>

                        <span class="fw-bold text-white text-end">

                            <i class="bi bi-code-slash me-1 text-primary"></i>

                            Desenvolvimento de Sistemas

                        </span>

                    </div>


                    <div class="hero-stat-row">

                        <span class="text-white-50 small">
                            Área
                        </span>

                        <span class="fw-bold text-white">

                            <i class="bi bi-database me-1 text-warning"></i>

                            Sistemas de Informação

                        </span>

                    </div>


                    <div class="hero-stat-row">

                        <span class="text-white-50 small">
                            Grupo
                        </span>

                        <span class="fw-bold text-white">

                            <i class="bi bi-people-fill me-1 text-success"></i>

                            6.º Grupo

                        </span>

                    </div>


                </div>

            </div>

        </div>

    </div>

</section>



{{-- ============================================================= --}}
{{-- SOBRE O SISTEMA --}}
{{-- ============================================================= --}}

<section
    id="sobre"
    class="section">


    <div class="container">


        <div class="section-title">


            <span class="badge-tag">
                O SISTEMA
            </span>


            <h2>
                Uma solução para gestão tecnológica
            </h2>


            <p>

                O SinTech é um sistema de gestão desenvolvido
                para organizar informações relacionadas com
                computadores, softwares, instalações, utilizadores
                e suporte técnico.

            </p>


        </div>


        <div class="row g-4">


            <div class="col-md-6">


                <div class="about-card">


                    <div class="about-icon-box">

                        <i class="bi bi-headset"></i>

                    </div>


                    <h4 class="fw-bold">

                        Contexto do Sistema

                    </h4>


                    <p class="text-muted">

                        A plataforma foi concebida para apoiar
                        o trabalho de Help Desk, permitindo uma
                        gestão centralizada dos equipamentos
                        tecnológicos e dos softwares utilizados.

                    </p>


                </div>

            </div>


            <div class="col-md-6">


                <div class="about-card">


                    <div class="about-icon-box">

                        <i class="bi bi-database-check"></i>

                    </div>


                    <h4 class="fw-bold">

                        Solução Proposta

                    </h4>


                    <p class="text-muted">

                        O sistema permite registar computadores,
                        associar responsáveis, catalogar softwares,
                        controlar instalações e acompanhar
                        equipamentos aposentados.

                    </p>


                </div>

            </div>


        </div>

    </div>

</section>



{{-- ============================================================= --}}
{{-- FUNCIONALIDADES --}}
{{-- ============================================================= --}}

<section
    id="funcionalidades"
    class="section section-light">


    <div class="container">


        <div class="section-title">


            <span class="badge-tag">
                FUNCIONALIDADES
            </span>


            <h2>
                O que o SinTech permite fazer?
            </h2>


            <p>

                A plataforma centraliza as principais informações
                necessárias para a administração dos recursos
                tecnológicos.

            </p>


        </div>


        <div class="row g-4">


            {{-- COMPUTADORES --}}

            <div class="col-sm-6 col-lg-3">


                <div class="feature-card">


                    <span class="feature-num">
                        01
                    </span>


                    <h5>
                        Computadores
                    </h5>


                    <p>

                        Registo e controlo dos equipamentos,
                        incluindo plaqueta, modelo CPU,
                        memória, data de entrada e responsável.

                    </p>


                </div>

            </div>


            {{-- SOFTWARES --}}

            <div class="col-sm-6 col-lg-3">


                <div class="feature-card">


                    <span class="feature-num">
                        02
                    </span>


                    <h5>
                        Softwares
                    </h5>


                    <p>

                        Catálogo de aplicações e sistemas,
                        permitindo controlar versão,
                        fabricante, tipo e estado.

                    </p>


                </div>

            </div>


            {{-- INSTALAÇÕES --}}

            <div class="col-sm-6 col-lg-3">


                <div class="feature-card">


                    <span class="feature-num">
                        03
                    </span>


                    <h5>
                        Instalações
                    </h5>


                    <p>

                        Registo dos softwares instalados
                        nos computadores e acompanhamento
                        do estado das instalações.

                    </p>


                </div>

            </div>


            {{-- APOSENTAÇÕES --}}

            <div class="col-sm-6 col-lg-3">


                <div class="feature-card">


                    <span class="feature-num">
                        04
                    </span>


                    <h5>
                        Aposentações
                    </h5>


                    <p>

                        Registo e acompanhamento dos
                        computadores retirados de serviço,
                        incluindo motivo e data.

                    </p>


                </div>

            </div>


            {{-- UTILIZADORES --}}

            <div class="col-sm-6 col-lg-3">


                <div class="feature-card">


                    <span class="feature-num">
                        05
                    </span>


                    <h5>
                        Utilizadores
                    </h5>


                    <p>

                        Gestão dos utilizadores e controlo
                        de acesso através de diferentes
                        perfis do sistema.

                    </p>


                </div>

            </div>


            {{-- RESPONSÁVEIS --}}

            <div class="col-sm-6 col-lg-3">


                <div class="feature-card">


                    <span class="feature-num">
                        06
                    </span>


                    <h5>
                        Responsáveis
                    </h5>


                    <p>

                        Associação dos computadores aos
                        respectivos responsáveis para
                        facilitar a gestão dos equipamentos.

                    </p>


                </div>

            </div>


            {{-- RELATÓRIOS --}}

            <div class="col-sm-6 col-lg-3">


                <div class="feature-card">


                    <span class="feature-num">
                        07
                    </span>


                    <h5>
                        Relatórios
                    </h5>


                    <p>

                        Consulta de informações consolidadas
                        sobre equipamentos, softwares,
                        instalações e aposentações.

                    </p>


                </div>

            </div>


            {{-- HELP DESK --}}

            <div class="col-sm-6 col-lg-3">


                <div class="feature-card">


                    <span class="feature-num">
                        08
                    </span>


                    <h5>
                        Help Desk
                    </h5>


                    <p>

                        Apoio à equipa técnica na consulta
                        e administração das informações
                        tecnológicas.

                    </p>


                </div>

            </div>


        </div>

    </div>

</section>



{{-- ============================================================= --}}
{{-- FLUXO DO SISTEMA --}}
{{-- ============================================================= --}}

<section
    id="fluxo"
    class="section">


    <div class="container">


        <div class="section-title">


            <span class="badge-tag">
                FUNCIONAMENTO
            </span>


            <h2>
                Como o sistema organiza a informação
            </h2>


            <p>

                O SinTech integra os principais elementos
                da gestão tecnológica numa única plataforma.

            </p>


        </div>


        <div class="row g-4">


            <div class="col-6 col-md-3">


                <div class="process-step">


                    <div class="process-circle">
                        1
                    </div>


                    <h5 class="fw-bold fs-6">
                        Computador
                    </h5>


                    <p class="small text-muted">

                        O equipamento é registado
                        no sistema.

                    </p>


                </div>

            </div>


            <div class="col-6 col-md-3">


                <div class="process-step">


                    <div class="process-circle">
                        2
                    </div>


                    <h5 class="fw-bold fs-6">
                        Software
                    </h5>


                    <p class="small text-muted">

                        Os softwares são catalogados
                        na plataforma.

                    </p>


                </div>

            </div>


            <div class="col-6 col-md-3">


                <div class="process-step">


                    <div class="process-circle">
                        3
                    </div>


                    <h5 class="fw-bold fs-6">
                        Instalação
                    </h5>


                    <p class="small text-muted">

                        Os softwares são associados
                        aos computadores.

                    </p>


                </div>

            </div>


            <div class="col-6 col-md-3">


                <div class="process-step">


                    <div class="process-circle">
                        4
                    </div>


                    <h5 class="fw-bold fs-6">
                        Help Desk
                    </h5>


                    <p class="small text-muted">

                        A equipa consulta e administra
                        os recursos tecnológicos.

                    </p>


                </div>

            </div>


        </div>

    </div>

</section>



{{-- ============================================================= --}}
{{-- GRUPO --}}
{{-- ============================================================= --}}

<section
    id="grupo"
    class="section section-light">


    <div class="container">


        <div class="section-title">


            <span class="badge-tag">
                SISTEMA ACADÉMICO DO 6.º GRUPO
            </span>


            <h2>
                Equipa de Desenvolvimento
            </h2>


            <p>

                Sistema desenvolvido pelo 6.º Grupo no âmbito do módulo
                de Desenvolvimento de Sistemas de Informação e Web
                Semântica, como requisito de avaliação do Curso de
                Mestrado em Sistemas de Informação.

            </p>


        </div>


        <div class="row g-4 justify-content-center">


            {{-- AMÂNDIO --}}

            <div class="col-12 col-sm-6 col-md-4">


                <div class="team-card">


                    <div class="team-avatar">
                        AJ
                    </div>


                    <h6 class="fw-bold mb-2">

                        Amândio Casimiro
                        António Jerónimo

                    </h6>


                    <small class="text-muted">

                        Membro do 6.º Grupo

                    </small>


                </div>

            </div>


            {{-- CALDEIRA --}}

            <div class="col-12 col-sm-6 col-md-4">


                <div class="team-card">


                    <div class="team-avatar">
                        CM
                    </div>


                    <h6 class="fw-bold mb-2">

                        Caldeira Alberto
                        Mucuala

                    </h6>


                    <small class="text-muted">

                        Membro do 6.º Grupo

                    </small>


                </div>

            </div>


            {{-- FLORINEL --}}

            <div class="col-12 col-sm-6 col-md-4">


                <div class="team-card">


                    <div class="team-avatar">
                        FA
                    </div>


                    <h6 class="fw-bold mb-2">

                        Florinel Daniel
                        Americo

                    </h6>


                    <small class="text-muted">

                        Membro do 6.º Grupo

                    </small>


                </div>

            </div>


        </div>

    </div>

</section>



{{-- ============================================================= --}}
{{-- CTA --}}
{{-- ============================================================= --}}

<section class="cta-section">


    <div class="container">


        <div class="cta-box">


            <div class="brand-icon mx-auto mb-3">

                <i class="bi bi-shield-lock-fill fs-4"></i>

            </div>


            <h2 class="fw-bold">

                Aceda à plataforma

            </h2>


            <p class="text-white-50">

                Entre no SinTech para gerir computadores,
                softwares, instalações, aposentações e relatórios.

            </p>


            <a
                href="{{ route('login') }}"
                class="btn-hero-primary d-inline-flex align-items-center gap-2">

                <i class="bi bi-box-arrow-in-right"></i>

                <span>
                    Entrar no SinTech
                </span>

            </a>


        </div>

    </div>

</section>



{{-- ============================================================= --}}
{{-- FOOTER --}}
{{-- ============================================================= --}}

<footer class="footer">


    <div class="container">


        <div class="row align-items-center">


            <div
                class="col-md-6 text-center text-md-start mb-2 mb-md-0">


                <span class="fw-bold text-white">

                    SinTech

                </span>


                <span class="ms-2">

                    | Sistema académico do 6.º Grupo

                </span>


            </div>


            <div
                class="col-md-6 text-center text-md-end">


                <span>

                    Academia Militar

                </span>

                <span class="mx-2">
                    |
                </span>

                <span>

                    Mestrado em Sistemas de Informação

                </span>


            </div>


        </div>


        <div class="text-center mt-3">

            © {{ date('Y') }} SinTech —
            Sistema académico do 6.º Grupo.

        </div>


    </div>

</footer>



{{-- ============================================================= --}}
{{-- BOOTSTRAP JS --}}
{{-- ============================================================= --}}

<script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js">
</script>


</body>

</html>