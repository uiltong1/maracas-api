<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class BasicAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $has_supplied_credentials = !(empty($_SERVER['PHP_AUTH_USER']) || empty($_SERVER['PHP_AUTH_PW']));

        $is_no_authenticated = (!$has_supplied_credentials || $_SERVER['PHP_AUTH_USER'] !== env('API_USER_BASIC') || !password_verify($_SERVER['PHP_AUTH_PW'], env('API_PASSWORD_BASIC')));
                
        if($is_no_authenticated) return response()->json(['message' => 'Não autorizado'], Response::HTTP_UNAUTHORIZED);

        return $next($request);
    }
}
