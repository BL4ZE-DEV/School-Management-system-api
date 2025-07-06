<?php

namespace App\Http\Middleware;

use App\Models\Tenant;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class TenantResolver
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $host = explode('.',$request->getHost());
        $mainDomain = "school-management-system-api.test";

        if($host === $mainDomain){
           return $next($request); 
        }

        $subdomain = str_replace(".{$mainDomain}", '', $host);

        if (empty($subdomain) || $subdomain === $host) {
            return $next($request);
        }

        $tenant = Tenant::where('subdomain', $host)->firstOrfail();
        
        config(['database.connections.tenants.database' => $tenant->database_name]);
        DB::purge('tenats');
        DB::reconnect('tenants');

        return $next($request);
    }
}