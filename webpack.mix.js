const mix = require('laravel-mix');
require('laravel-mix-merge-manifest');

const basePath = 'public/assets/';
const core = __dirname + '/resources/assets/';
const assets = __dirname + '/resources/assets/';
const adminLteBase = __dirname + '/resources/assets/adminlte/'

/*Login scripts
mix.scripts([
        core + 'bundles/libscripts.bundle.js',
        core + 'bundles/vendorscripts.bundle.js',
        core + 'bundles/mainscripts.bundle.js',
        core + 'vendor/sweetalert/sweetalert.min.js',
    ],
    basePath + 'core/js/login.js'
);*/




if (mix.inProduction()) {
    mix.version();
}
