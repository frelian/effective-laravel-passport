<?php

namespace App\Http\Middleware;

use App\Http\Helpers;
use Closure;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Session;

class IsAdminMiddleware
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
        $token = $request->bearerToken();
        $userAuth = Helpers::isAuthenticated($token);

        // Valido que exista datos del usuario
        if ( isset($userAuth['result']) && ($userAuth['result'] === false) ) {
            return redirect('login');
        }

        if ( $userAuth['role'] === 'client' ) {
            return redirect('login');
        }

        return $next($request);
    }
}
