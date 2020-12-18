<?php

Breadcrumbs::for('field.index', function ($breadcrumb) {
    $breadcrumb->parent('dashboard.index');
    $breadcrumb->push('Campos', route('field.index'));
});
