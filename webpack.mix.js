const mix = require('laravel-mix');
require('laravel-mix-merge-manifest');
mix.disableNotifications();

const basePath = 'public/assets/';
const core = __dirname + '/resources/assets/';
const assets = __dirname + '/resources/assets/';
const adminLteBase = __dirname + '/resources/assets/adminlte/';

// Login page
mix.styles([
        adminLteBase + 'css/fontawesome-free/css/all.min.css',
        adminLteBase + 'css/icheck-bootstrap/icheck-bootstrap.min.css',
        adminLteBase + 'css/adminlte.min.css'
    ],
    basePath + 'css/login.min.css'
);

//Login scripts
mix.scripts([
        adminLteBase + 'js/jquery/jquery.min.js',
        adminLteBase + 'js/bootstrap/js/bootstrap.bundle.min.js',
        adminLteBase + 'js/adminlte.min.js'
    ],
    basePath + 'js/login.min.js'
);

// Layouts Default Scripts
mix.styles([
    adminLteBase + 'select2/css/select2.min.css',
    adminLteBase + 'css/fontawesome-free/css/all.min.css',
    adminLteBase + 'tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css',
    adminLteBase + 'css/icheck-bootstrap/icheck-bootstrap.min.css',
    adminLteBase + 'css/adminlte.min.css',
    adminLteBase + 'jqvmap/jqvmap.min.css',
    adminLteBase + 'overlayScrollbars/css/OverlayScrollbars.min.css',
    adminLteBase + 'daterangepicker/daterangepicker.css',
    adminLteBase + 'summernote/summernote-bs4.min.css'
],
    basePath + 'css/default.min.css'
);

mix.scripts([
    adminLteBase + 'js/jquery/jquery.min.js',
    adminLteBase + 'jquery-ui/jquery-ui.min.js',
    adminLteBase + 'js/bootstrap/js/bootstrap.bundle.min.js',
    adminLteBase + 'chart.js/Chart.min.js',
    adminLteBase + 'sparklines/sparkline.js',
    adminLteBase + 'select2/js/select2.full.min.js',
    adminLteBase + 'jqvmap/jquery.vmap.min.js',
    adminLteBase + 'jqvmap/maps/jquery.vmap.usa.js',
    adminLteBase + 'jquery-knob/jquery.knob.min.js',
    adminLteBase + 'moment/moment.min.js',
    adminLteBase + 'daterangepicker/daterangepicker.js',
    adminLteBase + 'tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js',
    adminLteBase + 'summernote/summernote-bs4.min.js',
    adminLteBase + 'overlayScrollbars/js/jquery.overlayScrollbars.min.js',
    adminLteBase + 'js/demo.js',
    adminLteBase + 'js/dashboard.js',
    basePath + 'js/scripts.js',

    adminLteBase + 'js/adminlte.min.js'
],
    basePath + 'js/default.min.js'
);

if (mix.inProduction()) {
    mix.version();
}
