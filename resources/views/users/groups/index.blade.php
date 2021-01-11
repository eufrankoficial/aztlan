@extends('layouts.default', ['title' => 'Grupos de usuario', 'breadcrumb' => 'user.groups.index'])
	@section('content')
		<div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-2 col-md-2 col-sm-12 mb-3">
                                <a href="{{ route('user.groups.add') }}" class="btn btn-primary">
                                    <i class="fa fa-plus"></i>
                                    Adicionar
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Grupos de usuários</h3>

                        <div class="card-tools">
                            <form action="{{ route('user.groups.index') }}" method="GET">
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
                                <th>Name</th>
                                <th>Ações</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($groups as $group)
                                    <tr>
                                        <td>{{ $group->name }}</td>
                                        <td>
                                            <a href="{{ route('user.groups.detail', $group) }}" class="btn btn-default">
                                                <i class="fa fa-edit"></i>
                                                Editar
                                            </a>
                                            <delete-button-component url="{{ route('user.groups.delete', $group) }}"></delete-button-component>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        @include('partials.pagination', ['data' => $groups])
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
	@endsection
