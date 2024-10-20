<?php

use App\Http\Middleware\AuthMiddleware;
use App\Http\Middleware\CheckAgeMiddleware;
use App\Http\Middleware\CheckEmailVerifiedMiddleware;
use App\Http\Middleware\CheckLogoutMiddleware;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'auth' => AuthMiddleware::class,
            'checkLogout' => CheckLogoutMiddleware::class,
            'emailVerified' => CheckEmailVerifiedMiddleware::class
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
