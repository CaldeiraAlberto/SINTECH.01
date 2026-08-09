<?php
namespace App\Http\Controllers;
use App\Models\Computer;
use App\Models\Installation;
use App\Models\Retirement;
use App\Models\Software;
use App\Models\User;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
class ReportController extends Controller
{
    /**
     * Apresenta o relatório geral do sistema na web.
     */
    public function index(Request $request)
    {
        $pesquisa = $request->input('pesquisa');
        /*
        |--------------------------------------------------------------------------
        | Estatísticas gerais
        |--------------------------------------------------------------------------
        */
        $totalComputadores = Computer::count();
        $totalSoftwares = Software::count();
        $totalInstalacoes = Installation::count();
        $totalAposentacoes = Retirement::count();
        $totalUtilizadores = User::count();
        /*
        |--------------------------------------------------------------------------
        | Computadores por responsável
        |--------------------------------------------------------------------------
        */
        $computadoresPorResponsavel = Computer::with('responsavel')
            ->get()
            ->groupBy(function ($computer) {
                return $computer->responsavel?->name ?? 'Sem responsável';
            });
        /*
        |--------------------------------------------------------------------------
        | Instalações recentes
        |--------------------------------------------------------------------------
        */
        $instalacoes = Installation::with([
                'computer.responsavel',
                'software',
            ])
            ->when($pesquisa, function ($query) use ($pesquisa) {
                $query->where(function ($q) use ($pesquisa) {
                    $q->where('instalado_por', 'ILIKE', "%{$pesquisa}%")
                        ->orWhere('estado', 'ILIKE', "%{$pesquisa}%")
                        ->orWhereHas('computer', function ($computer) use ($pesquisa) {
                            $computer
                                ->where('plaqueta', 'ILIKE', "%{$pesquisa}%")
                                ->orWhere('modelo_cpu', 'ILIKE', "%{$pesquisa}%");
                        })
                        ->orWhereHas('software', function ($software) use ($pesquisa) {
                            $software
                                ->where('nome', 'ILIKE', "%{$pesquisa}%")
                                ->orWhere('fabricante', 'ILIKE', "%{$pesquisa}%");
                        });
                });
            })
            ->latest('data_instalacao')
            ->paginate(10)
            ->withQueryString();
        /*
        |--------------------------------------------------------------------------
        | Aposentações
        |--------------------------------------------------------------------------
        */
        $aposentacoes = Retirement::with([
                'computer.responsavel',
            ])
            ->latest('data_aposentacao')
            ->take(10)
            ->get();
        /*
        |--------------------------------------------------------------------------
        | Renderizar View Web
        |--------------------------------------------------------------------------
        */
        return view('reports.index', compact(
            'totalComputadores',
            'totalSoftwares',
            'totalInstalacoes',
            'totalAposentacoes',
            'totalUtilizadores',
            'computadoresPorResponsavel',
            'instalacoes',
            'aposentacoes',
            'pesquisa'
        ));
    }
    /**
     * Gera e descarrega o relatório geral em PDF.
     */
    public function pdf()
    {
        $dataRelatorio = now();
        $totalComputadores = Computer::count();
        $totalAposentados = Retirement::count();
        $computadoresAtivos = Computer::whereDoesntHave('retirement')->count();
        $computadoresAtribuidos = Computer::whereNotNull('responsavel_id')->whereDoesntHave('retirement')->count();
        $computadoresDisponiveis = Computer::whereNull('responsavel_id')->whereDoesntHave('retirement')->count();
        $totalResponsaveis = User::where('role', 'responsavel')->count();
        $totalSoftwares = Software::count();
        $totalInstalacoes = Installation::count();
        $instalacoesInstaladas = Installation::where('estado', 'Instalado')->count();
        $instalacoesAtualizadas = Installation::where('estado', 'Atualizado')->count();
        $instalacoesRemovidas = Installation::where('estado', 'Removido')->count();
        $computadoresPorResponsavel = User::where('role', 'responsavel')
            ->withCount([
                'computers' => function ($query) {
                    $query->whereDoesntHave('retirement');
                }
            ])
            ->orderBy('name')
            ->get();
        $softwaresMaisInstalados = Software::withCount('installations')
            ->orderByDesc('installations_count')
            ->orderBy('nome')
            ->take(10)
            ->get();
        $instalacoesRecentes = Installation::with([
            'computer',
            'computer.responsavel',
            'software',
            'responsavel',
        ])
        ->latest('data_instalacao')
        ->take(10)
        ->get();
        $aposentacoesRecentes = Retirement::with([
            'computer',
            'computer.responsavel',
        ])
        ->latest('data_aposentacao')
        ->take(10)
        ->get();
        $pdf = Pdf::loadView(
            'reports.pdf',
            compact(
                'dataRelatorio',
                'totalComputadores',
                'computadoresAtivos',
                'computadoresAtribuidos',
                'computadoresDisponiveis',
                'totalResponsaveis',
                'totalSoftwares',
                'totalInstalacoes',
                'instalacoesInstaladas',
                'instalacoesAtualizadas',
                'instalacoesRemovidas',
                'totalAposentados',
                'computadoresPorResponsavel',
                'softwaresMaisInstalados',
                'instalacoesRecentes',
                'aposentacoesRecentes'
            )
        );
        return $pdf->download(
            'relatorio-geral-sintech-' . now()->format('Y-m-d_H-i') . '.pdf'
        );
    }
}