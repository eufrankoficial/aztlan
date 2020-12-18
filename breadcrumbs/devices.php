<?php


/**
 * Devices
 */
Breadcrumbs::for('device.index', function ($breadcrumb) {
    $breadcrumb->parent('dashboard.index');
    $breadcrumb->push('Dispositivos', route('device.index'));
});

Breadcrumbs::for('device.create', function ($breadcrumb) {
    $breadcrumb->parent('device.index');
    $breadcrumb->push('Novo dispositivo', route('device.create'));
});


Breadcrumbs::for('device.detail', function ($breadcrumb, $device) {
    $breadcrumb->parent('device.index');
    $breadcrumb->push($device->code_device, route('device.detail', $device));
});
