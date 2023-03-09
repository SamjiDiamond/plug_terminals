<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ServiceAuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $header = $request->header('Authorization', '');

        if($header != env('SERVICE_AUTH')){
            return response()->json(['success' => false, 'message' => "ERROR 123990"]);
        }
        return $next($request);
    }
}
