@extends('layouts.default', [
    'title' => 'Adicionar menu',
    'breadcrumb' => 'menu.create'
])
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <form method="POST" action="{{ route('menu.store') }}">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="card card-primary">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="inputMenu">Menu</label>
                                    <input type="text" class="form-control" id="inputMenu" name="menu">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="inputRoute">Rota</label>
                                    <input type="text" class="form-control" id="inputRoute" name="route">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="inputIcon">Icon</label>
                                    <input type="text" class="form-control" id="inputIcon" name="icon">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 col-md-6">
                                <div class="form-group">
                                    <label>Filhos</label>
                                    <div class="multiselect_div">
                                        <select name="parents[]" class="select2" id="parents" multiple="multiple">
                                            @foreach($menus as $menu)
                                                <option value="{{ $menu->slug }}">
                                                    {{ $menu->menu }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
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
