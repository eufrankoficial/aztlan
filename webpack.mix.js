const mix = require('laravel-mix');
require('laravel-mix-merge-manifest');

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

if (mix.inProduction()) {
    mix.version();
}
