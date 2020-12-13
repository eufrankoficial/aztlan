@extends('layouts.default',
    [
        'title' => 'Dispositivos',
        'breadcrumb' => 'device.index',
    ]
)
@section('content')
    <div class="row">
        @foreach($devices as $device)
            <div class="col-lg-3 col-6">
                <div class="small-box bg-{{ $device->detail->status }}">
                    <div class="inner">
                        <h3>{{ $device->vehicle->license_plate }}</h3>

                        <p>Caminhão</p>
                    </div>
                    <a href="{{ route('device.detail', $device->id) }}" class="small-box-footer">Detalhes <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
    @endforeach
    </div>
@stop
