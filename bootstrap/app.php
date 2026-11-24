<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

// PHP 8.5 menandai PDO::MYSQL_ATTR_SSL_CA sebagai deprecated, dan konstanta itu masih dipakai
// config/database.php bawaan Laravel 11 di vendor. File config dimuat sebelum Laravel mengatur
// penanganan error, sehingga peringatannya tercetak di halaman. Setelah itu Laravel sendiri yang
// mengatur error_reporting (deprecation masuk log, tidak ditampilkan). Hapus setelah upgrade ke Laravel 12.
if (PHP_VERSION_ID >= 80500) {
    error_reporting(error_reporting() & ~E_DEPRECATED);
}

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
