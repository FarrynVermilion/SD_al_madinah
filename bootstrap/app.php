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
        $middleware->alias([
            'user-access'=> \App\Http\Middleware\check_role::class,
            'cors' => \App\Http\Middleware\Cors::class,
        ]);
        $middleware->validateCsrfTokens(except: [
            // 'login.api','register.api','logout.api'
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
