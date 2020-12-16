@extends('layouts.default', [
    'title' => 'Usuários',
    'breadcrumb' => 'user.index'
])
    @section('content')
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-2 col-md-2 col-sm-12 mb-3">
                                <a href="{{ route('user.create') }}" class="btn btn-primary">
                                    <i class="fa fa-plus"></i>
                                    Adicionar
                                </a>
                            </div>
                            <div class="col-lg-2 col-md-2 col-sm-12 mb-3">
                                <a href="{{ route('menu.create') }}" class="btn btn-success">
                                    <i class="fa fa-file-export"></i>
                                    Exportar
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Usuários</h3>

                        <div class="card-tools">
                            <form action="{{ route('user.index') }}" method="GET">
                                <div class="input-group input-group-sm" style="width: 150px;">
                                        <input type="text" name="term" class="form-control float-right" placeholder="Pesquisar" value="{{ old('term', request()->get('term')) }}">

                                        <div class="input-group-append">
                                            <button type="submit" class="btn btn-default">
                                                <i class="fas fa-search"></i>
                                            </button>
                                        </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nome</th>
                                <th>Email</th>
                                <th>Username</th>
                                <th>Atualizado em</th>
                                <th>Ações</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $user)
                                    <tr>
                                        <td>183</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->username }}</td>
                                        <td>{{ $user->updated_at->format('d/m/Y h:i:s') }}</td>
                                        <td>
                                            <a href="{{ route('user.detail', $user) }}" class="btn btn-default">
                                                <i class="fa fa-edit"></i>
                                                Editar
                                            </a>
                                            <delete-button-component url="{{ route('user.delete', $user) }}"></delete-button-component>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        @include('partials.pagination', ['data' => $users])
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
    @endsection
