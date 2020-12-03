@extends('layouts.default', ['title' => 'Novo', 'breadcrumb' => 'device.create'])
@section('content')
    <div class="row">
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>Online</h3>
                    <p>Status</p>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Informações do dispositivo</h3>
                </div>
                <create-device-form-component action="{{ route('device.store') }}" vehicles="{{ $vehicles }}"></create-device-form-component>
            </div>
        </div>
    </div>
@endsection
