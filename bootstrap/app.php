<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        
        // TAMBAHKAN ATURAN CORS DI SINI
        $middleware->validateCsrfTokens(except: [
            'api/*', // Melepaskan proteksi CSRF untuk semua jalur API
        ]);

    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();