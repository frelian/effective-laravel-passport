<?php

namespace App\Http;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Session;

class Helpers {

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public static function isAuthenticated($token = null)
    {
        $token = isset($token) ? $token : Session::get('token');
        // $token = \Cache::get('token');

        if ($token ) {
            $client = new Client(['base_uri' => 'http://127.0.0.1:8001/api/']);
            $headers = [
                'Authorization' => 'Bearer ' . $token,
                'Accept'        => 'application/json',
            ];

            try {

                $response = $client->request('POST', 'profile', [
                    'headers' => $headers
                ]);

                $body = $response->getBody();
                $content = $body->getContents();

                $response_json = json_decode($content);

                $data = [
                    'id'      => $response_json->user->id,
                    'names'   => $response_json->user->names,
                    'email'   => $response_json->user->email,
                    'role'    => $response_json->user->role,
                    'result'  => true,
                    'message' => 'Ok'
                ];
                return $data;

            } catch (ClientException $e) {

                $str = strpos($e->getMessage(), '{');
                $json = substr($e->getMessage(), $str);
                $json = json_decode($json);
                $message = $json->message;
                $response = [
                    'result'  => false,
                    'message' => $message
                ];

                return $response;
            }
        }

        $response = [
            'result'  => false,
            'message' => "Su sesión ha caducado"
        ];

        return $response;
    }

    /**
     * Metodo para agregar paginacion a una coleccion de datos
     *
     * @var array
     */
    public static function paginate($items, $perPage = 5, $page = null, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }
}
