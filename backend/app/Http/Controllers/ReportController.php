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
     * Display the system general report on the web.
     */
    public function index(Request $request)
    {
        $search = $request->input('search') ?? $request->input('pesquisa');

        /*
        |--------------------------------------------------------------------------
        | General Statistics
        |--------------------------------------------------------------------------
        */
        $totalComputers = Computer::count();
        $totalSoftwares = Software::count();
        $totalInstallations = Installation::count();
        $totalRetirements = Retirement::count();
        $totalUsers = User::count();

        /*
        |--------------------------------------------------------------------------
        | Computers by Responsible User
        |--------------------------------------------------------------------------
        */
        $computersByResponsible = Computer::with('responsavel')
            ->get()
            ->groupBy(function ($computer) {
                return $computer->responsavel?->name ?? 'Sem responsável';
            });

        /*
        |--------------------------------------------------------------------------
        | Recent Installations
        |--------------------------------------------------------------------------
        */
        $installations = Installation::with([
                'computer.responsavel',
                'software',
            ])
            ->when($search, function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('instalado_por', 'ILIKE', "%{$search}%")
                        ->orWhere('estado', 'ILIKE', "%{$search}%")
                        ->orWhereHas('computer', function ($computer) use ($search) {
                            $computer
                                ->where('plaqueta', 'ILIKE', "%{$search}%")
                                ->orWhere('modelo_cpu', 'ILIKE', "%{$search}%");
                        })
                        ->orWhereHas('software', function ($software) use ($search) {
                            $software
                                ->where('nome', 'ILIKE', "%{$search}%")
                                ->orWhere('fabricante', 'ILIKE', "%{$search}%");
                        });
                });
            })
            ->latest('data_instalacao')
            ->paginate(10)
            ->withQueryString();

        /*
        |--------------------------------------------------------------------------
        | Retirements
        |--------------------------------------------------------------------------
        */
        $retirements = Retirement::with([
                'computer.responsavel',
            ])
            ->latest('data_aposentacao')
            ->take(10)
            ->get();

        /*
        |--------------------------------------------------------------------------
        | Render Web View
        |--------------------------------------------------------------------------
        */
        return view('reports.index', compact(
            'totalComputers',
            'totalSoftwares',
            'totalInstallations',
            'totalRetirements',
            'totalUsers',
            'computersByResponsible',
            'installations',
            'retirements',
            'search'
        ));
    }

    /**
     * Generate and download the general report in PDF.
     */
    public function pdf()
    {
        $reportDate = now();
        $totalComputers = Computer::count();
        $totalRetirements = Retirement::count();
        $activeComputers = Computer::whereDoesntHave('retirement')->count();
        $assignedComputers = Computer::whereNotNull('responsavel_id')->whereDoesntHave('retirement')->count();
        $availableComputers = Computer::whereNull('responsavel_id')->whereDoesntHave('retirement')->count();
        $totalResponsibles = User::where('role', 'responsavel')->count();
        $totalSoftwares = Software::count();
        $totalInstallations = Installation::count();
        $installedInstallations = Installation::where('estado', 'Instalado')->count();
        $updatedInstallations = Installation::where('estado', 'Atualizado')->count();
        $removedInstallations = Installation::where('estado', 'Removido')->count();

        $computersByResponsible = User::where('role', 'responsavel')
            ->withCount([
                'computers' => function ($query) {
                    $query->whereDoesntHave('retirement');
                }
            ])
            ->orderBy('name')
            ->get();

        $topInstalledSoftwares = Software::withCount('installations')
            ->orderByDesc('installations_count')
            ->orderBy('nome')
            ->take(10)
            ->get();

        $recentInstallations = Installation::with([
            'computer',
            'computer.responsavel',
            'software',
            'responsavel',
        ])
        ->latest('data_instalacao')
        ->take(10)
        ->get();

        $recentRetirements = Retirement::with([
            'computer',
            'computer.responsavel',
        ])
        ->latest('data_aposentacao')
        ->take(10)
        ->get();

        $pdf = Pdf::loadView(
            'reports.pdf',
            compact(
                'reportDate',
                'totalComputers',
                'activeComputers',
                'assignedComputers',
                'availableComputers',
                'totalResponsibles',
                'totalSoftwares',
                'totalInstallations',
                'installedInstallations',
                'updatedInstallations',
                'removedInstallations',
                'totalRetirements',
                'computersByResponsible',
                'topInstalledSoftwares',
                'recentInstallations',
                'recentRetirements'
            )
        );

        return $pdf->download(
            'relatorio-geral-sintech-' . now()->format('Y-m-d_H-i') . '.pdf'
        );
    }
}