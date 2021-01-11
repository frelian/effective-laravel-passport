<?php

namespace App\Http\Controllers;

use App\Http\Helpers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class HomeController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $userAuth = Helpers::isAuthenticated();

        // Valido para redirigir
        if ($userAuth['result']) {
            return view('admin.dashboard', compact('userAuth'));
        }

        return view('auth.login');
    }
}
