@extends('layouts.default', [
    'title' => 'Menus',
    'breadcrumb' => 'menu.index'
])
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
						@can('menu.create')
							<div class="col-lg-2 col-md-2 col-sm-12 mb-3">
								<a href="{{ route('menu.create') }}" class="btn btn-primary">
									<i class="fa fa-plus"></i>
									Adicionar
								</a>
							</div>
						@endcan
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
                    <div class="card-tools">
                        <form action="{{ route('user.index') }}" method="GET">
                            <div class="input-group input-group-sm">
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
                                    <delete-button-component url="{{ route('menu.delete', $menu) }}"></delete-button-component>
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
