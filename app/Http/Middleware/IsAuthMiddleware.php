<?php

namespace App\Http\Middleware;

use Closure;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Session;

class IsAuthMiddleware
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
        $token = Session::get('token');

        // Valido que exista el token
        if (empty($token)) {
            return redirect('login');
        }

        $client = new Client(['base_uri' => 'http://127.0.0.1:8001/api/']);
        $headers = [
            'Authorization' => 'Bearer ' . $token,
            'Accept'        => 'application/json',
        ];

        try {
            $response = $client->request('POST', 'logued', [
                'headers' => $headers
            ]);

        } catch (ClientException $e) {
            return redirect('login');
        }

        return $next($request);
    }
}
