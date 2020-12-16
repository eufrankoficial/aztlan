<?php

/**
 * Devices
 */
Breadcrumbs::for('company.index', function ($breadcrumb) {
    $breadcrumb->parent('dashboard.index');
    $breadcrumb->push('Empresas', route('company.index'));
});

Breadcrumbs::for('company.create', function ($breadcrumb) {
    $breadcrumb->parent('company.index');
    $breadcrumb->push('Nova empresa', route('company.create'));
});

Breadcrumbs::for('company.detail', function ($breadcrumb, $company) {
    $breadcrumb->parent('company.index');
    $breadcrumb->push($company->fantasy_name, route('company.detail', $company));
});
