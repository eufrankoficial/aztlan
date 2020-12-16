@extends('layouts.default', [
    'title' => 'Menus',
    'breadcrumb' => 'menu.index'
])
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Menus</h3>

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
                            <th>Menu</th>
                            <th>Rota</th>
                            <th>Ações</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($menus as $menu)
                            <tr>
                                <td>{{ $menu->id }}</td>
                                <td>{{ $menu->menu }}</td>
                                <td>{{ $menu->route }}</td>
                                <td>
                                    <a href="{{ route('menu.detail', $menu) }}" class="btn btn-default">
                                        <i class="fa fa-edit"></i>
                                        Editar
                                    </a>
                                </td>
                                <td>
                                    <a href="#" class="btn btn-danger">
                                        <i class="fa fa-trash"></i>
                                        Excluir
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                    @include('partials.pagination', ['data' => $menus])
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>
@endsection
