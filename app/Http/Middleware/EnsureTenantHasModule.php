<?php

namespace App\Http\Middleware;

use App\Models\Tenant;
use Closure;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureTenantHasModule
{
    /**
     * Handle an incoming request.
     *
     * @param Closure(Request): (Response) $next
     * @throws AuthorizationException
     */
    public function handle(Request $request, Closure $next, string $module ): Response
    {
        /** @var Tenant $tenant */
        $tenant = tenant();

        if ($tenant->hasModule($module)) {
            return $next($request);
        }

        throw new AuthorizationException("Tenant does not have access to the {$module} module.");
    }
}
