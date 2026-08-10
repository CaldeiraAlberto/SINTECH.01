<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )

    ->withMiddleware(function (Middleware $middleware): void {

        /*
        |--------------------------------------------------------------------------
        | Proxy / HTTPS - Render
        |--------------------------------------------------------------------------
        |
        | O Render termina o HTTPS no proxy e encaminha a requisição
        | para o container. O Laravel precisa confiar nesse proxy para
        | reconhecer corretamente o esquema HTTPS original.
        |
        */

        $middleware->trustProxies(at: '*');

        /*
        |--------------------------------------------------------------------------
        | Middleware Personalizados
        |--------------------------------------------------------------------------
        */

        $middleware->alias([
            'role' => \App\Http\Middleware\RoleMiddleware::class,
        ]);
    })

    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })

    ->create();