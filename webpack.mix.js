let mix = require('laravel-mix');



/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

// admin css
mix.js('resources/assets/js/app.js', 'public/js')
    .sass('resources/assets/sass/app.scss', 'public/css')
    .styles([
        'public/assets/admin/css/sb-admin-2.min.css',
        'public/assets/admin/css/nunito.css',
        'public/assets/admin/css/all.min.css',
        'public/assets/admin/css/icon.css',
    ], 'public/css/admin.css')
    .version();

// admin js
mix.scripts([
    'public/assets/admin/js/sb-admin-2.js',
    'public/assets/admin/js/font.js',
    'public/assets/admin/js/fontas.js',
    'public/assets/admin/js/icon.js',
], 'public/js/admin.js');

// client css
mix.styles([
    'public/assets/client/css/lato.css',
    'public/assets/client/css/mon.css',
    'public/assets/client/css/style-starter.css',
], 'public/css/client.css')
    .scripts([
        'public/assets/client/js/jquery.min.js',
        'public/assets/client/js/jquery.waypoints.min.js',
        'public/assets/client/js/jquery.countup.js',
        'public/assets/client/js/mdbootstrap.min.js',
        'public/assets/client/js/custom.js',
        'public/assets/client/js/mdjquery.min.js',
        'public/assets/client/js/mdb.min.js',
        'public/assets/client/js/mdpopper.min.js',
        'public/assets/client/js/bootstrap.min.js',
        'public/assets/client/js/owl.carousel.js',
        'public/assets/client/js/jquery.zoomslider.min.js',
        'public/assets/client/js/modernizr-2.6.2.min.js',
        'public/assets/client/js/jquery.min.js',
        'public/assets/client/js/theme-change.js',
        'public/assets/client/js/jquery-3.3.1.min.js',
        'public/assets/client/js/bootstrap.bundle.min.js',
        'public/assets/client/js/jquery-3.5.1.slim.min.js',
    ], 'public/js/client.js')
    .scripts('resources/assets/js/ajax.js', 'public/js/ajax.js')
    .scripts('resources/assets/js/jquery-3.5.1.min.js', 'public/js/jquery-3.5.1.min.js')
    .version();


mix.styles([
    'public/assets/admin/vendor/fontawesome-free/css/all.min.css',
], 'public/fonts/font-awe.css')
mix.copy('node_modules/font-awesome/fonts/*', 'public/fonts');