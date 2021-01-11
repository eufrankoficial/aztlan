<?php

/**
 * Devices
 */
Breadcrumbs::for('user.groups.index', function ($breadcrumb) {
    $breadcrumb->parent('dashboard.index');
    $breadcrumb->push('Grupos de usuários', route('user.groups.index'));
});

Breadcrumbs::for('user.groups.create', function ($breadcrumb) {
    $breadcrumb->parent('user.groups.index');
    $breadcrumb->push('Novo grupo', route('user.groups.create'));
});

Breadcrumbs::for('user.groups.detail', function ($breadcrumb, $groupUser) {
    $breadcrumb->parent('user.groups.index');
    $breadcrumb->push($groupUser->name, route('user.groups.detail', $groupUser));
});
