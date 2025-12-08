<?php

use App\Http\Middleware\AuthStudent;
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

    // middleware web default
    $middleware->web(append: [
        \Illuminate\Http\Middleware\AddLinkHeadersForPreloadedAssets::class,
        \App\Http\Middleware\HandleInertiaRequests::class,
    ]);

    // REGISTER MIDDLEWARE STUDENT DI SINI
    $middleware->alias([
        'student' => \App\Http\Middleware\AuthStudent::class,
    ]);

})

    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
