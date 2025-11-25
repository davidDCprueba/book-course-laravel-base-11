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
        //
        $middleware->validateCsrfTokens(except: [
            'webhook/*',          // si tus webhooks están bajo /webhook/...
            'mi-servicio/*',      // si quieres ser más específico
            'ruta-que-uses',      // o agrega la ruta exacta
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
