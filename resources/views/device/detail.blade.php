@extends('layouts.default', ['title' => 'Caminhão ' . $device->vehicle->license_plate, 'breadcrumb' => 'device.detail', 'param' => $device])
    @section('content')
        <view-device-detail-component devicejson="{{ $device }}"></view-device-detail-component>

        <div class="row">
            <div class="col-lg-12 col-sm-12">
                <div class="card">
                    <div class="card-header ui-sortable-handle" style="cursor: move;">
                        <h3 class="card-title">
                            <i class="fas fa-chart-line mr-1"></i>
                            Histórico
                        </h3>
                    </div>
                    <div class="card-body">
                        <render-chart-component data="{{ $chart }}"></render-chart-component>
                    </div>
                </div>
            </div>
        </div>
    @endsection
