@extends('layouts.default', [
    'title' => 'Nova empresa',
    'breadcrumb' => 'company.create',
])
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <form method="POST" action="{{ route('company.store') }}">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="card card-primary">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="inputCompanyName">Razão Social</label>
                                    <input type="text" class="form-control" id="inputCompanyName" name="company_name">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="inputFantasyName">Nome Fantasia</label>
                                    <input type="text" class="form-control" id="inputFantasyName" name="fantasy_name">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="inputLogo">Logo</label>
                                    <input type="text" class="form-control" id="inputLogo" name="logo">
                                </div>
                            </div>
                        </div>
                        <cpf-cnpj-component value="false" error="false"></cpf-cnpj-component>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Salvar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
