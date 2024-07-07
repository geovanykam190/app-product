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

mix.js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css');


// mix.combine([
//     'node_modules/sweetalert/dist/sweetalert.min.css'
// ], 'public/css/app.css');

mix.combine([
    'node_modules/sweetalert/dist/sweetalert.min.js'
], 'public/js/app.js');

mix.combine([
    'resources/css/custom.css'
], 'public/css/custom.css');

mix.combine([
    'resources/js/custom.js'
], 'public/js/custom.js');

