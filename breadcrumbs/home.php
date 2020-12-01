<?php

Breadcrumbs::for('home.index', function ($breadcrumb) {
    $breadcrumb->push('Página Inicial', route('dashboard.index'));
});
