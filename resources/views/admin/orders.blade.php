@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-lg-end user-actions">
            <a href="{{ route('dashboard') }}" class="btn btn-link mr-2">
                Dashboard
            </a>
            <a href="{{ route('users') }}" class="btn btn-primary">
                Usuarios
            </a>
        </div>
    </div>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Listado de ordenes</div>

                    <div class="card-body">
                        @if ($total > 0)
                            <table class="table table-hover">
                            <thead class="thead-dark">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nombre del cliente</th>
                                <th scope="col">Email del cliente</th>
                                <th scope="col">Dirección de la orden</th>
                                <th scope="col">Fecha de creación</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($orders as $order )
                                    <tr>
                                        <th scope="row">{{ $order->id_order }}</th>
                                        <td>{{ $order->names }}</td>
                                        <td>{{ $order->email }}</td>
                                        <td>{{ $order->direction }}</td>
                                        <td>{{ $order->created_at }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                            <div class="pagination">
                                {{ $orders->links() }}
                            </div>
                        @else
                            <div class="alert alert-info" role="alert">
                                Aun no existen ordenes registradas en el sistema...
                            </div>
                        @endif
                    </div>
                    <div class="card-footer text-muted">
                        @if ($total > 1)
                            Total de {{ $total }} ordenes registradas.
                        @elseif($total === 1)
                            Sólo existe una orden registrada.
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
