@extends('layouts.default', [
    'title' => 'Empresas',
    'breadcrumb' => 'company.index'
])
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-2 col-md-2 col-sm-12 mb-3">
                            <a href="{{ route('company.create') }}" class="btn btn-primary">
                                <i class="fa fa-plus"></i>
                                Adicionar
                            </a>
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-12 mb-3">
                            <a href="{{ route('company.create') }}" class="btn btn-success">
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
                        <form action="{{ route('company.index') }}" method="GET">
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
                            <th>Razão social</th>
                            <th>Nome Fantasia</th>
                            <th>CPF/CNPJ</th>
                            <th>Atualizado em</th>
                            <th>Ações</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($companies as $company)
                            <tr>
                                <td>{{ $company->id }}</td>
                                <td>{{ $company->company_name }}</td>
                                <td>{{ $company->fantasy_name }}</td>
                                <td>{{ $company->cpf_cnpj }}</td>
                                <td>{{ $company->updated_at->format('d/m/Y h:i:s') }}</td>
                                <td>
                                    <a href="{{ route('company.detail', $company) }}" class="btn btn-default">
                                        <i class="fa fa-edit"></i>
                                        Editar
                                    </a>
                                    <delete-button-component url="{{ route('company.delete', $company) }}"></delete-button-component>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                    @include('partials.pagination', ['data' => $companies])
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>
@endsection
