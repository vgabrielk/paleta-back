<?php


namespace App\Http\Middleware;

use Closure;
use App\Support\TenantContext;

class SetTenant
{
    public function handle($request, Closure $next)
    {
        if (auth()->check()) {
            TenantContext::$tenantId = auth()->user()->tenant_id;
        }

        return $next($request);
    }
}
