<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Relatório Geral SinTech</title>
    <style>
        body {
            font-family: 'Helvetica', 'Arial', sans-serif;
            font-size: 11px;
            color: #333;
            margin: 0;
            padding: 0;
        }
        .header {
            background-color: #0f2547;
            color: #ffffff;
            padding: 15px 20px;
            text-align: justify;
        }
        .header h1 {
            margin: 0;
            font-size: 18px;
            text-transform: uppercase;
        }
        .header p {
            margin: 5px 0 0;
            font-size: 10px;
            opacity: 0.8;
        }
        .section-title {
            font-size: 12px;
            font-weight: bold;
            color: #0f2547;
            border-bottom: 2px solid #0f2547;
            padding-bottom: 3px;
            margin-top: 15px;
            margin-bottom: 10px;
            text-transform: uppercase;
        }
        .stats-grid {
            width: 100%;
            margin-bottom: 15px;
        }
        .stats-box {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            padding: 8px;
            text-align: center;
            border-radius: 4px;
        }
        .stats-box .number {
            font-size: 16px;
            font-weight: bold;
            color: #0f2547;
        }
        .stats-box .label {
            font-size: 9px;
            color: #64748b;
            text-transform: uppercase;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
        }
        table th {
            background-color: #0f2547;
            color: #ffffff;
            font-size: 9px;
            padding: 6px;
            text-align: left;
            text-transform: uppercase;
        }
        table td {
            border-bottom: 1px solid #e2e8f0;
            padding: 6px;
            font-size: 10px;
        }
        .footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            font-size: 9px;
            text-align: center;
            color: #94a3b8;
            border-top: 1px solid #e2e8f0;
            padding-top: 5px;
        }
    </style>
</head>
<body>
    <!-- Cabeçalho -->
    <div class="header">
        <h1>SinTech — Relatório Geral de TI</h1>
        <p>Emitido em: {{ \Carbon\Carbon::parse($dataRelatorio)->format('d/m/Y H:i') }}</p>
    </div>
    <!-- Indicadores -->
    <div class="section-title">Resumo do Inventário</div>
    <table class="stats-grid">
        <tr>
            <td class="stats-box">
                <div class="number">{{ $totalComputadores }}</div>
                <div class="label">Computadores</div>
            </td>
            <td class="stats-box">
                <div class="number">{{ $computadoresAtivos }}</div>
                <div class="label">Ativos</div>
            </td>
            <td class="stats-box">
                <div class="number">{{ $totalSoftwares }}</div>
                <div class="label">Softwares</div>
            </td>
            <td class="stats-box">
                <div class="number">{{ $totalInstalacoes }}</div>
                <div class="label">Instalações</div>
            </td>
            <td class="stats-box">
                <div class="number">{{ $totalAposentados }}</div>
                <div class="label">Aposentados</div>
            </td>
        </tr>
    </table>
    <!-- Tabela Softwares Mais Instalados -->
    <div class="section-title">Top Softwares Instalados</div>
    <table>
        <thead>
            <tr>
                <th>Software</th>
                <th>Fabricante</th>
                <th>Tipo</th>
                <th style="text-align: center;">Total Instalações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($softwaresMaisInstalados as $sw)
                <tr>
                    <td><strong>{{ $sw->nome }}</strong> ({{ $sw->versao }})</td>
                    <td>{{ $sw->fabricante }}</td>
                    <td>{{ $sw->tipo }}</td>
                    <td style="text-align: center;"><strong>{{ $sw->installations_count }}</strong></td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <!-- Tabela Últtimas Instalações -->
    <div class="section-title">Instalações Recentes</div>
    <table>
        <thead>
            <tr>
                <th>Plaqueta</th>
                <th>Software</th>
                <th>Responsável</th>
                <th>Instalado Por</th>
                <th>Data</th>
            </tr>
        </thead>
        <tbody>
            @foreach($instalacoesRecentes as $inst)
                <tr>
                    <td>{{ $inst->computer->plaqueta ?? 'N/A' }}</td>
                    <td>{{ $inst->software->nome ?? 'N/A' }}</td>
                    <td>{{ $inst->computer->responsavel->name ?? 'Sem responsável' }}</td>
                    <td>{{ $inst->instalado_por }}</td>
                    <td>{{ \Carbon\Carbon::parse($inst->data_instalacao)->format('d/m/Y') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="footer">
        SinTech — Sistema de Informação para o Registo e Gestão dos Softwares
    </div>
</body>
</html>


