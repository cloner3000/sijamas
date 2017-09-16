var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Less
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function(mix) {
    mix.scripts([
        'jquery-1.11.0.js',
        'modernizr-2.6.2.min.js',
        'SmoothScroll.js',
        'jquery.easing.1.3.js',
        'jquery.fancybox.js',
        'jquery-ui.js',
        'bootstrap.min.js',
        'material.min.js',
        'material-kit.js',
        'jquery.bxslider.js',
        'TweenMax.min.js',
        'js_lib.js',
        'js_run.js',
        'apps.js',
    ]);

    mix.styles([
        'font-awesome.min.css',
        'jquery-ui.css',
        'jquery.fancybox.css',
        'camera.css',
        'jquery.bxslider.css',
        'bootstrap.min.css',
        'font-awesome.min.css',
        'material-kit.css',
        'style.css',
        'media1024.css',
        'media768.css',
        'media480.css',
        'media320.css',
    ]);

    mix.version(['css/all.css', 'js/all.js']);
});
