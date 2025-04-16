<?php

namespace App\Http\Middleware;

use App\Support\TenantContext;
use Closure;
use Illuminate\Http\Request;

class TenantIdentification
{
    public function handle(Request $request, Closure $next)
    {
        if (auth()->check()) {
            TenantContext::$tenantId = auth()->user()->tenant_id;
        }

        return $next($request);
    }
}
