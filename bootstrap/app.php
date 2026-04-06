<?php

use App\Http\Middleware\AuthTimeout;
use App\Http\Middleware\CachePageResponse;
use App\Http\Middleware\ContentSecurityPolicy;
use App\Http\Middleware\EnsureSuperAdmin;
use App\Http\Middleware\OptimizeCaching;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {

        // FIX: Jangan trim field base64
        $middleware->trimStrings(except: [
            'featured_image_base64',
        ]);

        // FIX: Jangan ubah base64 jadi null
        // Di Laravel 12, except menggunakan array of field names atau closures
        // Closure: return true = skip (jangan convert), return false = convert
        $middleware->convertEmptyStringsToNull(except: [
            fn($request) => $request->has('featured_image_base64'),
        ]);

        $middleware->append(ContentSecurityPolicy::class);
        $middleware->append(CachePageResponse::class);
        $middleware->append(OptimizeCaching::class);
        $middleware->web(append: [
            \Illuminate\Http\Middleware\AddLinkHeadersForPreloadedAssets::class,
        ]);
        $middleware->alias([
            'super_admin'  => EnsureSuperAdmin::class,
            'auth.timeout' => AuthTimeout::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
