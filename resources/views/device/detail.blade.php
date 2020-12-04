@extends('layouts.default', ['title' => $device->code_device, 'breadcrumb' => 'device.detail', 'param' => $device])
    @section('content')
        <view-device-detail-component devicejson="{{ $device }}"></view-device-detail-component>
    @endsection
