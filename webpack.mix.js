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
   .js('resources/js/ajax-modal-form.js', 'public/js')
   .sass('resources/sass/app.scss', 'public/css')
   .sass('resources/sass/slidebars.scss', 'public/css')
   .sass('resources/sass/style.scss', 'public/css')
   .sass('resources/sass/style-responsive.scss', 'public/css')
   .sass('resources/sass/bootstrap-reset.scss', 'public/css');
