<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RegistrationAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if($request->get('refferal_code'))
        {
           if($request->hasCookie('refferel_code') == 1)
           {

           }
           else
           {
            return $next($request)->withCookie(cookie('refferel_code', $request->get('refferal_code'),60*24*30));
           }
        }
        return $next($request);

    }
}
