<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;
use App\Http\Helpers;
use App\Models\Direction;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use Validator;
use App\Models\User;
use GuzzleHttp\Client;
use Request;
use Session;

class UserController extends Controller
{
    /**
     * Retornar la vista de iniciar sesión
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function login() {
        return view('login');
    }

    /**
     * Obtener datos del usuario logueado
     * Web
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function profile()
    {
        $user = Auth::user();
        return response()->json(compact('user'), 200);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userAuth = Helpers::isAuthenticated();

        // Query para consultar usuarios:
        // Excluyo al usuario autenticado
        $users = DB::table('users')
            ->where('id', '<>', $userAuth['id'])
            ->paginate(5);

        $total = $users->total();

        // Valido para redirigir
        if ($userAuth['result']) {
            return view('admin.users')
                ->with('userAuth', $userAuth)
                ->with('users', $users)
                ->with('total', $total);
        }

        return view('auth.login');
    }

    /**
     * Metodo para cerrar sesion por GET
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function logoutWeb(){
        Session::put('token', '');

        session()->forget('token');
        session()->flush();
        Auth::logout();
        return redirect('/login');
    }

    /**
     * D) Ver todos los usuarios con sus respectivas direcciones (paginadas).
     * API: api/admin/users-directions
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function apiUsersWithDirections(){

        $users = User::select('id as id_user', 'names')->get()->toArray();
        $dirs  = Direction::select('id as id_dir', 'direction', 'user_id as fk_user_id')->get()->toArray();

        $users_ok = [];
        foreach ( $users as $user) {
            $dir_aux = [];
            foreach ( $dirs as $dir) {
                if ( $dir['fk_user_id'] == $user['id_user'] ) {

                    // Elimino nuevas lineas "\n" y retorno de carro que se generaron del Faker
                    $direction = trim( str_replace(array("\n", "\r"), ' ', $dir['direction']));
                    $dir_aux[] = $direction;
                }
            }

            $user['directions'] = $dir_aux;
            $users_ok[] = $user;
        }

        // Agrego la ruta del servidor ya que la genera ejemplo:
        //    "/?page=1" a "http://127.0.0.1:8000/api/admin/users-directions?page=1",
        $options = [
            "path" => "http://127.0.0.1:8000/api/admin/products",
            "pageName" => "page"
        ];

        $data = Helpers::paginate($users_ok, 5, null, $options);
        return response()->json($data, 200);
    }
}
