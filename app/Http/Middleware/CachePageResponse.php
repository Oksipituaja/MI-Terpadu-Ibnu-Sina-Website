<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Symfony\Component\HttpFoundation\Response;

class CachePageResponse
{
    private array $noCacheRoutes = [
        '/login',
        '/register',
        '/logout',
        '/forgot-password',
        '/reset-password',
        '/dashboard',
        '/admin-panel',
        '/admin',
        '/livewire',
        '/ppdb',        // form pendaftaran — ada CSRF
        '/files',       // FIX: binary file serving — jangan cache ke DB
    ];

    public function handle(Request $request, Closure $next): Response
    {
        if (! $request->isMethod('GET') || auth()->check()) {
            return $next($request);
        }

        $path = $request->getPathInfo();
        foreach ($this->noCacheRoutes as $route) {
            if ($path === $route || str_starts_with($path, $route . '/')) {
                return $next($request);
            }
        }

        $fullUrl = $path . ($request->getQueryString() ? '?' . $request->getQueryString() : '');
        $cacheKey = 'page.response.' . md5($fullUrl);

        if (Cache::has($cacheKey)) {
            $cached = Cache::get($cacheKey);
            return response($cached)
                ->header('Content-Type', 'text/html; charset=UTF-8')
                ->header('X-Cache', 'HIT');
        }

        $response = $next($request);

        // FIX: Hanya cache response text/html — skip binary (image, file, dll)
        $contentType = $response->headers->get('Content-Type', '');
        if (! str_contains($contentType, 'text/html')) {
            return $response;
        }

        // Jangan cache halaman yang mengandung Livewire component
        // karena wire:id berisi CSRF token dan state component
        $content = $response->getContent();
        $hasLivewire = str_contains($content, 'wire:id') || str_contains($content, 'wire:initial-data');

        if ($response->isSuccessful() && ! $response->headers->has('X-No-Cache') && ! $hasLivewire) {
            Cache::put($cacheKey, $content, 3600);
            $response->header('X-Cache', 'MISS');
        } else {
            $response->header('X-Cache', 'SKIP');
        }

        return $response;
    }
}
