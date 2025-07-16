<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\RoleMiddleware; // Importa tu RoleMiddleware

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // Registra tu middleware de ruta aquí
        $middleware->alias([
            'role' => RoleMiddleware::class,
        ]);

        // Si tienes middlewares globales o de grupo 'web' o 'api' que necesiten ser configurados,
        // también lo harías aquí. Por ejemplo:
        // $middleware->web(append: [
        //     \App\Http\Middleware\VerifyCsrfToken::class,
        // ]);
        // $middleware->api(prepend: [
        //     \Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class,
        // ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
