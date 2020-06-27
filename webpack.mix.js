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

mix.js('resources/js/app.js', 'public/js/admin.js');

mix.styles([
      'public/bower_components/bootstrap/dist/css/bootstrap.min.css',
      'public/dist/css/AdminLTE.min.css',
      'public/dist/css/skins/_all-skins.min.css',
      'public/bower_components/select2/dist/css/select2.min.css',
    'resources/css/admin.css'
   ], 'public/css/app.css');
mix.scripts([
      'public/js/admin.js',
      'public/bower_components/jquery/dist/jquery.min.js',
      'public/bower_components/jquery-ui/jquery-ui.min.js',
      'public/bower_components/select2/dist/js/select2.full.min.js',
      'public/bower_components/jquery-slimscroll/jquery.slimscroll.min.js',
      'public/bower_components/fastclick/lib/fastclick.js',
      'public/dist/js/adminlte.min.js',
      'public/dist/js/demo.js',
], 'public/js/app.js');

