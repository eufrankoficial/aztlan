@extends('layouts.default', [
    'title' => 'Editar campos',
    'breadcrumb' => 'field.index'
])
@section('content')
    <div class="row">
        <device-field-list-component getfieldsaction="{{ route('field.device.detail') }}"></device-field-list-component>
    </div>
@endsection
