<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class KasirTypeMiddleware
{
    /**
     * Ensure kasir has correct kasir_type
     * Usage: ->middleware('kasir_type:hotel')
     */
    public function handle(Request $request, Closure $next, string $type): Response
    {
        $user = $request->user();

        if (!$user || $user->role !== 'kasir' || $user->kasir_type !== $type) {
            abort(403, 'Akses ditolak. Tipe kasir tidak sesuai.');
        }

        return $next($request);
    }
}