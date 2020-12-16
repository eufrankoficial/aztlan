<?php

/**
 * Devices
 */
Breadcrumbs::for('menu.index', function ($breadcrumb) {
    $breadcrumb->parent('dashboard.index');
    $breadcrumb->push('Menus', route('menu.index'));
});

Breadcrumbs::for('menu.create', function ($breadcrumb) {
    $breadcrumb->parent('menu.index');
    $breadcrumb->push('Novo menu', route('menu.create'));
});

Breadcrumbs::for('menu.detail', function ($breadcrumb, $menu) {
    $breadcrumb->parent('menu.index');
    $breadcrumb->push('Menu ', route('menu.detail', $menu));
});
