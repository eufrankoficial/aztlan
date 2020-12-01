<?php

/**
 * Devices
 */
Breadcrumbs::for('user.index', function ($breadcrumb) {
    $breadcrumb->parent('dashboard.index');
    $breadcrumb->push('Usuários', route('user.index'));
});

Breadcrumbs::for('user.create', function ($breadcrumb) {
    $breadcrumb->parent('user.index');
    $breadcrumb->push('Novo usuário', route('user.create'));
});

Breadcrumbs::for('user.detail', function ($breadcrumb, $user) {
    $breadcrumb->parent('user.index');
    $breadcrumb->push('Editar ', route('user.detail', $user->public_id));
});
