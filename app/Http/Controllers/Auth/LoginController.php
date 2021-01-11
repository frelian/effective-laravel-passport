<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\UserController;
use App\Http\Helpers;
use App\Providers\RouteServiceProvider;
use GuzzleHttp\Client;
// use http\Env\Request;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Support\Facades\Redirect;
use Request;
use Session;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function loginWeb() {
        $request = Request::all();
        $email = $request['email'];
        $password = $request['password'];

        $client = new Client([
            'headers' => [ 'Content-Type' => 'application/json' ]
        ]);

        try {
            $response = $client->post('http://127.0.0.1:8001/api/login',
                ['body' => json_encode(
                    [
                        'email'    => $email,
                        'password' => $password
                    ]
                )]
            );

            $body = $response->getBody();
            $content = $body->getContents();
            $response_json = json_decode($content);

            Session::put('token', $response_json->token->token);
            // \Cache::put('token', $response_json->token->token, 10);

            return redirect()->route('dashboard');

        } catch (ClientException $e) {

            $str = strpos($e->getMessage(), '{');
            $json = substr($e->getMessage(), $str);
            $json = json_decode($json);
            $result = $json->message;

            return Redirect::back()->withErrors([$result]);
        }
    }
}
