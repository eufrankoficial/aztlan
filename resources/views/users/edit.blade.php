@extends('layouts.default', [
    'title' => 'Editar - ' . $user->name,
    'breadcrumb' => 'user.detail',
    'param' => $user
])
    @section('content')
        <div class="row">
            <div class="col-lg-12">
                <form method="POST" action="{{ route('user.update', $user->public_id) }}">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="card card-primary">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="inputName">Nome</label>
                                        <input type="text" class="form-control" id="inputName" name="name" value="{{ $user->name }}">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="text" class="form-control" id="email" name="email" value="{{ $user->email }}">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="username">Nome de usuário</label>
                                        <input type="text" class="form-control" id="username" name="username" value="{{ $user->username }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <h5 class="mb-2">Atualizar senha</h5>
                                </div>

                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label for="password">Senha</label>
                                        <input type="password" class="form-control" id="password" name="password">
                                    </div>
                                </div>

                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label for="repeatPassword">Senha</label>
                                        <input type="password" class="form-control" id="repeatPassword" name="repeat_password">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <label for="">&nbsp;</label>
                                    <div class="form-group">
                                        <button type="button" class="btn btn-info btn-flat">Atualizar</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Salvar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    @endsection
