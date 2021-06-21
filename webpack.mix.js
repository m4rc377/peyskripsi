const mix = require('laravel-mix');

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

mix.js('resources/js/app.js', 'public/js').sourceMaps()
   .sass('resources/sass/app.scss', 'public/css')
   .copy('node_modules/@fortawesome/fontawesome-free/webfonts', 'public/webfonts');

/* mix.scripts([
    'node_modules/select2/dist/js/select2.full.min.js',
    'node_modules/admin-lte/dist/js/adminlte.js',
    'node_modules/bootstrap/dist/js/bootstrap.js',
    //'node_modules/datatables.net/js/jquery.dataTables.js',
    //'node_modules/datatables.net-bs/js/dataTables.bootstrap.js',
    // other scripts
], 'public/js/app.js'); */


