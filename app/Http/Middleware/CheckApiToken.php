<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\User;
use Symfony\Component\HttpFoundation\HeaderBag;

class CheckApiToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $request->server->set('HTTP_ACCEPT', 'application/json'); 

        if(!empty(trim($request->input('api_token')))){
            $request->server->set('HTTP_AUTHORIZATION', 'Bearer '.$request->input('api_token'));
        }
        $request->headers = new HeaderBag($request->server->getHeaders()); 

        if(empty($request->headers->get('Authorization'))){
            return response()->json('Invalid Token');
        }

        return $next($request);
    }
}
