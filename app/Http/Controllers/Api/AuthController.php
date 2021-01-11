<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api')->except(['login', 'logout', 'register']);
    }

    /**
     * B) Metodo para iniciar sesión APIREST
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login()
    {
        if (Auth::attempt(['email' => request('email'), 'password' => request('password')])) {
            $user = Auth::user();
            $success['token'] = $user->createToken('appToken')->accessToken;

            return response()->json([
                'success' => true,
                'token' => $success,
                'user' => $user
            ]);
        } else {

            return response()->json([
                'success' => false,
                'message' => 'El email o el password no son los correctos.',
            ], 401);
        }
    }

    /**
     * B) Metodo para crear nuevo usuario APIREST
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'names'    => 'required',
            'email'    => 'required|email|unique:users',
            'password' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors(),
            ], 401);
        }
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $success['token'] = $user->createToken('appToken')->accessToken;
        return response()->json([
            'success' => true,
            'token'   => $success,
            'user'    => $user
        ]);
    }

    /**
     * Metodo para cerrar sesión
     *
     * @param Request $res
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout(Request $res)
    {
        if (Auth::user()) {
            $user = Auth::user()->token();
            $user->revoke();

            return response()->json([
                'success' => true,
                'message' => 'Se cerro la sesión correctamente.'
            ]);
        }else {
            return response()->json([
                'success' => false,
                'message' => 'No se logró cerrar la sesión.'
            ]);
        }
    }

    /**
     * C) Para el perfil de usuario (API): /api/user/profile
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function apiProfile()
    {
        // 1. Mostrar sus datos..........Ok
        // 2. Mostrar sus órdenes........OK
        // 3. Mostrar sus direcciones....Ok

        $user = auth()->user();

        if (!empty($user)) {
            $orders = DB::table('orders')
                ->where('user_id', $user->id)
                ->get();

            $directions = DB::table('directions')
                ->where('user_id', $user->id)
                ->get();

            return response()->json([
                'success' => true,
                'message' => 'Datos encontrados.',
                'profile' => $user,
                'orders'  => $orders,
                'directions' => $directions
            ], 200);
        }

        return response()->json([
            'success' => false,
            'message' => 'Usuario no autenticado...'
        ]);
    }

    /**
     * Obtener datos del usuario logueado
     * API: /api/profile
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function profile()
    {
        return response()->json(['user' => auth()->user()], 200);
    }

    /**
     * Verificar si el usuario está logueado o no
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function isLogued()
    {
        return response()->json(['isLogued' => true], 200);
    }
}
