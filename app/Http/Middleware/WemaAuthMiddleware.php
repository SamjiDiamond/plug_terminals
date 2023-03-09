<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class WemaAuthMiddleware
{
    /**
     * Handle an incoming reqwuest.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $req=$request->bearerToken();

        if($req != env('WEMA_AUTH')){
            return response()->json(['success' => '07', 'status_desc' => 'Valid auth required']);
        }

        return $next($request);
    }
}
