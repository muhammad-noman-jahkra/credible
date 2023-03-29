<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class checkUser
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
        log::channel('temp')->info("Location Log : ",['loc'=>file_get_contents('http://www.geoplugin.net/json.gp?ip='.$request->ip())]);
        // dd([$_SERVER['HTTP_USER_AGENT'],strpos($_SERVER['HTTP_USER_AGENT'],"Windows")]);
        if(strpos($_SERVER['HTTP_USER_AGENT'],"Windows") === false ){
            return response()->view('errors.os_warning',['message'=>'You are not login from windows']);
        }
        return $next($request);
    }
}
