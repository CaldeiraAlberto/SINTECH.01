<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ComputerController;
use App\Http\Controllers\SoftwareController;
use App\Http\Controllers\InstallationController;
use App\Http\Controllers\RetirementController;
use App\Http\Controllers\ReportController;

/*
|--------------------------------------------------------------------------
| Página Inicial
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('welcome');
})->name('home');

/*
|--------------------------------------------------------------------------
| Autenticação
|--------------------------------------------------------------------------
*/
Route::get('/login', [AuthController::class, 'showLogin'])
    ->name('login');
Route::post('/login', [AuthController::class, 'login'])
    ->name('login.store');
Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

/*
|--------------------------------------------------------------------------
| Dashboard
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');
});

/*
|--------------------------------------------------------------------------
| Administração - Help Desk
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:helpdesk'])->group(function () {

    /*
    |--------------------------------------------------------------------------
    | Utilizadores
    |--------------------------------------------------------------------------
    */
    Route::get('/users', [UserController::class, 'index'])
        ->name('users.index');
    Route::get('/users/create', [UserController::class, 'create'])
        ->name('users.create');
    Route::post('/users', [UserController::class, 'store'])
        ->name('users.store');
    
    // Rota de eliminação em massa
    Route::delete('/users/bulk-delete', [UserController::class, 'bulkDelete'])
        ->name('users.bulk-delete');

    Route::get('/users/{id}/edit', [UserController::class, 'edit'])
        ->name('users.edit');
    Route::put('/users/{id}', [UserController::class, 'update'])
        ->name('users.update');
    Route::patch('/users/{id}/toggle-status', [UserController::class, 'toggleStatus'])
        ->name('users.toggle-status');
    Route::delete('/users/{id}', [UserController::class, 'destroy'])
        ->name('users.destroy');

    /*
    |--------------------------------------------------------------------------
    | Computadores
    |--------------------------------------------------------------------------
    */
    Route::get('/computers', [ComputerController::class, 'index'])
        ->name('computers.index');
    Route::get('/computers/create', [ComputerController::class, 'create'])
        ->name('computers.create');
    Route::post('/computers', [ComputerController::class, 'store'])
        ->name('computers.store');
    
    // Rota de eliminação em massa
    Route::delete('/computers/bulk-delete', [ComputerController::class, 'bulkDelete'])
        ->name('computers.bulk-delete');

    Route::get('/computers/{id}/edit', [ComputerController::class, 'edit'])
        ->name('computers.edit');
    Route::put('/computers/{id}', [ComputerController::class, 'update'])
        ->name('computers.update');
    Route::delete('/computers/{id}', [ComputerController::class, 'destroy'])
        ->name('computers.destroy');

    /*
    |--------------------------------------------------------------------------
    | Softwares
    |--------------------------------------------------------------------------
    */
    Route::get('/softwares', [SoftwareController::class, 'index'])
        ->name('softwares.index');
    Route::get('/softwares/create', [SoftwareController::class, 'create'])
        ->name('softwares.create');
    Route::post('/softwares', [SoftwareController::class, 'store'])
        ->name('softwares.store');
    
    // Rota de eliminação em massa
    Route::delete('/softwares/bulk-delete', [SoftwareController::class, 'bulkDelete'])
        ->name('softwares.bulk-delete');

    Route::get('/softwares/{id}/edit', [SoftwareController::class, 'edit'])
        ->name('softwares.edit');
    Route::put('/softwares/{id}', [SoftwareController::class, 'update'])
        ->name('softwares.update');
    Route::delete('/softwares/{id}', [SoftwareController::class, 'destroy'])
        ->name('softwares.destroy');

    /*
    |--------------------------------------------------------------------------
    | Instalações
    |--------------------------------------------------------------------------
    */
    Route::get('/installations', [InstallationController::class, 'index'])
        ->name('installations.index');
    Route::get('/installations/create', [InstallationController::class, 'create'])
        ->name('installations.create');
    Route::post('/installations', [InstallationController::class, 'store'])
        ->name('installations.store');
    
    // Rota de eliminação em massa
    Route::delete('/installations/bulk-delete', [InstallationController::class, 'bulkDelete'])
        ->name('installations.bulk-delete');

    Route::get('/installations/{id}/edit', [InstallationController::class, 'edit'])
        ->name('installations.edit');
    Route::put('/installations/{id}', [InstallationController::class, 'update'])
        ->name('installations.update');
    Route::delete('/installations/{id}', [InstallationController::class, 'destroy'])
        ->name('installations.destroy');

    /*
    |--------------------------------------------------------------------------
    | Aposentações
    |--------------------------------------------------------------------------
    */
    Route::delete('/retirements/bulk-delete', [RetirementController::class, 'bulkDelete'])
        ->name('retirements.bulk-delete');
    Route::resource('retirements', RetirementController::class);

    /*
    |--------------------------------------------------------------------------
    | Relatórios
    |--------------------------------------------------------------------------
    */
    Route::get('/reports', [ReportController::class, 'index'])
        ->name('reports.index');
    Route::get('/reports/pdf', [ReportController::class, 'pdf'])
        ->name('reports.pdf');
});

/*
|--------------------------------------------------------------------------
| Consulta - Responsável
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:responsavel'])->group(function () {
    Route::get('/meus-softwares', [InstallationController::class, 'meusSoftwares'])
        ->name('responsavel.softwares');
});