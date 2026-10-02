<?php
namespace App\Http\Middleware;
use Closure;
use Illuminate\Http\Request;

class OwnerOnly {
    public function handle(Request $r, Closure $next) {
        abort_unless($r->user() && $r->user()->role === 'pemilik', 403, 'Hanya untuk pemilik.');
        return $next($r);
    }
}
