@extends('layouts.default', ['title' => $device->code_device, 'breadcrumb' => 'device.detail', 'param' => $device])
    @section('content')
        <view-device-detail-component devicejson="{{ $device }}"></view-device-detail-component>

        <div class="row">
            <div class="col-md-12 col-sm-12">
                <render-chart-component></render-chart-component>
            </div>
        </div>
    @endsection
