<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

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
        // dd([$_SERVER['HTTP_USER_AGENT'],strpos($_SERVER['HTTP_USER_AGENT'],"Windows")]);
        if(strpos($_SERVER['HTTP_USER_AGENT'],"Windows") === false ){
            return response()->view('errors.os_warning',['message'=>'You are not login from windows']);
        }
        return $next($request);
    }
}
