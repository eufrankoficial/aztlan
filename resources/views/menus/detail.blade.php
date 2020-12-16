@extends('layouts.default', [
    'title' => 'Editar menu ' . $menu->menu,
    'breadcrumb' => 'menu.detail',
    'param' => $menu
])
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <menu-edit-component
                menuprop="{{ $menu }}"
                action="{{ route('menu.update', $menu) }}"
                menuselect="{{ $menus }}"
                parents="{{ $parents }}">
            </menu-edit-component>
        </div>
    </div>
@endsection
