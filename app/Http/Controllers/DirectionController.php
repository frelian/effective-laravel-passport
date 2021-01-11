<?php

namespace App\Http\Controllers;

use App\Direction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DirectionController extends Controller
{
    /**
     * C) Para el perfil de usuario: Mostrar sus direcciones
     * API: /api/user/directions
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function apiClientDirections(){

        $id_user = auth()->user()->id;

        $dir = DB::table('directions')
            ->where('user_id', $id_user)
            ->get();

        return response()->json([
            'success' => true,
            'message' => 'ok.',
            'id_user' => $id_user,
            'dir'     => $dir
        ]);
    }
}
