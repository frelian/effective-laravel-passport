@extends('layouts.app')

@section('content')

    <div class="container">

        <div class="row justify-content-center">
            <div class="col">
                <h4 class="text-center">Bienvenido {{ $userAuth['names']  }}</h4>
            </div>
        </div>

        <div class="row justify-content-center dashboard-actions">
            <div class="col-2">
                <a class="btn btn-lg btn-primary" href="{{ route('users') }}">
                    <i class="glyphicon glyphicon-user pull-left"></i><span>Usuarios<br><small>Ver todos los usuarios</small></span>
                </a>

            </div>
            <div class="col-2">
                <a class="btn btn-lg btn-success " href="{{ route('orders') }}">
                    <i class="glyphicon glyphicon-dashboard pull-left"></i><span>Ordenes<br><small>Ver todas las ordenes</small></span>
                </a>
            </div>
        </div>
    </div>
@endsection
