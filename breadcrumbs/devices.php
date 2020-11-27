<?php


/**
 * Devices
 */
Breadcrumbs::for('device.index', function ($breadcrumb) {
    $breadcrumb->parent('dashboard.index');
    $breadcrumb->push('Dispositivos', route('device.index'));
});

/*
Breadcrumbs::for('beer_type.add', function ($breadcrumb) {
    $breadcrumb->parent('beer_type.index');
    $breadcrumb->push(__('New type'), route('beer_type.add'));
});

Breadcrumbs::for('beer_type.edit', function ($breadcrumb, $beerType) {
    $breadcrumb->parent('beer_type.index');
    $breadcrumb->push($beerType->name, route('beer_type.edit', $beerType->slug));
});*/
