<?php

namespace App\Http\Controllers;

use App\Http\Helpers;
use App\Models\User;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userAuth = Helpers::isAuthenticated();

        // Query para consultar usuarios:
        $orders =  DB::table('orders')
            ->leftJoin('users', 'users.id', '=', 'orders.user_id')
            ->leftJoin('directions', 'directions.id', '=', 'orders.direction_id')
            ->select('orders.id as id_order', 'orders.order_info', 'orders.created_at', 'users.id', 'users.names',
                'users.email', 'directions.id', 'directions.direction')
            ->paginate(4);

        $total = $orders->total();

        // Valido para redirigir
        if ($userAuth['result']) {
            return view('admin.orders')
                ->with('userAuth', $userAuth)
                ->with('orders', $orders)
                ->with('total', $total);
        }

        return view('auth.login');
    }

    /**
     * C) Para el perfil de usuario: Mostrar sus ordenes
     * API: /api/user/orders
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function apiClientOrders(){

        $id_user = auth()->user()->id;

        $orders = DB::table('orders')
            ->where('user_id', $id_user)
            ->get();

        return response()->json([
            'success' => true,
            'message' => 'okk.',
            'id_user' => $id_user,
            'orders'  => $orders
        ]);

    }

    /**
     * D) Ver todas las ordenes con su respectivo usuario (paginadas).
     * API: api/admin/orders-users
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function apiOrdersWithUsers() {

        $users  = User::select('id as id_user', 'names')->get()->toArray();
        $orders = Order::select('orders.id as id_order', 'orders.order_info', 'orders.user_id as fk_user_id',
                'directions.direction')
            ->leftJoin('directions', 'directions.id', '=', 'orders.direction_id')
            ->get()->toArray();

        $users_ok = [];
        foreach ( $users as $user) {
            $order_aux = [];
            foreach ( $orders as $order) {
                if ( $order['fk_user_id'] == $user['id_user'] ) {
                    $order_aux[] = [
                        "id_order"  => $order['id_order'],
                        "direction" => $order['direction']
                    ];

                }
            }

            $user['orders'] = $order_aux;
            $users_ok[] = $user;
        }
        // Agrego la ruta del servidor ya que la genera ejemplo:
        //    "/?page=1" a "http://127.0.0.1:8000/api/admin/users-directions?page=1",
        $options = [
            "path" => "http://127.0.0.1:8000/api/admin/orders-users",
            "pageName" => "page"
        ];

        $data = Helpers::paginate($users_ok, 5, null, $options);
        return response()->json($data, 200);
    }
}
