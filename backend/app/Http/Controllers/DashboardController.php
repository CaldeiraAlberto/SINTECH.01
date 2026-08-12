<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Computer;
use App\Models\Software;
use App\Models\Installation;
use App\Models\Retirement;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Dashboard principal do SinTech.
     */
    public function index()
    {
        $user = Auth::user();

        if ($user->role === 'responsavel') {
            // 1. Total de utilizadores no sistema
            $totalUsers = User::count();

            // 2. Computadores do responsável
            $totalComputers = Computer::where('responsavel_id', $user->id)->count();

            // 3. Instalações nas máquinas do responsável
            $totalInstallations = Installation::where(function ($q) use ($user) {
                $q->where('responsavel_id', $user->id)
                  ->orWhereHas('computer', function ($c) use ($user) {
                      $c->where('responsavel_id', $user->id);
                  });
            })->count();

            // 4. Softwares distintos instalados nas máquinas do responsável
            $totalSoftwares = Software::whereHas('installations', function ($q) use ($user) {
                $q->where('responsavel_id', $user->id)
                  ->orWhereHas('computer', function ($c) use ($user) {
                      $c->where('responsavel_id', $user->id);
                  });
            })->distinct()->count();

            // 5. Aposentações vinculadas aos computadores do responsável
            $totalRetirements = Retirement::whereHas('computer', function ($q) use ($user) {
                $q->where('responsavel_id', $user->id);
            })->count();

            // 6. Instalações recentes para o responsável
            $recentInstallations = Installation::with(['computer', 'software'])
                ->where(function ($q) use ($user) {
                    $q->where('responsavel_id', $user->id)
                      ->orWhereHas('computer', function ($c) use ($user) {
                          $c->where('responsavel_id', $user->id);
                      });
                })
                ->latest('data_instalacao')
                ->take(5)
                ->get();

        } else {
            // Totais gerais para Administração / Help Desk
            $totalUsers = User::count();
            $totalComputers = Computer::count();
            $totalSoftwares = Software::count();
            $totalInstallations = Installation::count();
            $totalRetirements = Retirement::count();

            $recentInstallations = Installation::with(['computer', 'software'])
                ->latest('data_instalacao')
                ->take(5)
                ->get();
        }

        $totalReports = 0;

        return view('dashboard.index', compact(
            'user',
            'totalUsers',
            'totalComputers',
            'totalSoftwares',
            'totalInstallations',
            'totalRetirements',
            'totalReports',
            'recentInstallations'
        ));
    }
}