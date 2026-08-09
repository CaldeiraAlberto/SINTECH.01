<?php
namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Computer;
use App\Models\Software;
use App\Models\Installation;
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
            // 2. Computadores do João
            $totalComputers = Computer::where('responsavel_id', $user->id)->count();
            // 3. Instalações nas máquinas do João (ou onde ele é o responsável)

            $totalInstallations = Installation::where('responsavel_id', $user->id)
                ->orWhereHas('computer', function ($q) use ($user) {
                    $q->where('responsavel_id', $user->id);
                })->count();

            // 4. Softwares distintos instalados nas máquinas do João
            $totalSoftwares = Software::whereHas('installations', function ($q) use ($user) {
                $q->where('responsavel_id', $user->id)
                  ->orWhereHas('computer', function ($c) use ($user) {
                      $c->where('responsavel_id', $user->id);
                  });
            })->distinct()->count();
        } else {
            
            // Totais para a Administração (Help Desk)
            $totalUsers = User::count();
            $totalComputers = Computer::count();
            $totalSoftwares = Software::count();
            $totalInstallations = Installation::count();
        }
        $totalReports = 0;
        return view('dashboard.index', [
            'user' => $user,
            'totalUsers' => $totalUsers,
            'totalComputers' => $totalComputers,
            'totalSoftwares' => $totalSoftwares,
            'totalInstallations' => $totalInstallations,
            'totalReports' => $totalReports,
        ]);
    }
}