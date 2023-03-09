<?php

namespace App\Http\Middleware;

use App\Models\Business;
use Closure;
use Illuminate\Http\Request;

class SecretkeyMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\JsonResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $req=$request->bearerToken();

        if($req == ""){
            return response()->json(['success' => false, 'message' => 'Kindly use bearer token in your header']);
        }

        $biz=Business::where('secret_key',$req)->first();
        if(!$biz){
            return response()->json(['success' => false, 'message' => 'Valid secret key required']);
        }

        if($biz->status == 0){
            return response()->json(['success' => false, 'message' => 'Business is currently disabled']);
        }

        $request->merge(["biz" => $biz]);

        return $next($request);
    }
}
