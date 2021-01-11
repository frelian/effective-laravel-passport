@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-lg-end user-actions">
            <a href="{{ route('dashboard') }}" class="btn btn-link mr-2">
                Dashboard
            </a>
            <a href="{{ route('orders') }}" class="btn btn-success">
                Ordenes
            </a>
        </div>
    </div>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Listado de usuarios</div>

                    <div class="card-body">
                        @if ($users->hasPages())
                            <table class="table table-hover">
                                <thead class="thead-dark">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nombres</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Rol</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($users as $user )
                                        <tr>
                                            <th scope="row">{{ $user->id }}</th>
                                            <td>{{ $user->names }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->role }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="pagination">
                                {{ $users->links() }}
                            </div>
                        @else
                            <div class="alert alert-info" role="alert">
                                Sin usuarios en el sistema...
                            </div>
                        @endif
                    </div>

                    <div class="card-footer text-muted">
                        @if ($total > 1)
                                Total de {{ $total }} usuarios registrados.
                        @elseif($total === 1)
                                Sólo existe un usuario registrado.
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
