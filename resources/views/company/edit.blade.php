@extends('layouts.default', [
    'title' => 'Editar - ' . $company->company_name,
    'breadcrumb' => 'company.detail',
    'param' => $company
])
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <form method="POST" action="{{ route('company.update', $company) }}">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="card card-primary">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="inputCompanyName">Razão Social</label>
                                    <input type="text" class="form-control" id="inputCompanyName" name="company_name" value="{{ $company->company_name }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="inputFantasyName">Nome Fantasia</label>
                                    <input type="text" class="form-control" id="inputFantasyName" name="fantasy_name" value="{{ $company->fantasy_name }}">
                                </div>
                            </div>
                        </div>
                        <cpf-cnpj-component value="{{ $company->cpf_cnpj }}" error="false"></cpf-cnpj-component>

						<image-upload-component action="{{ route('upload.file') }}" company="{{ $company }}"></image-upload-component>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Salvar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
