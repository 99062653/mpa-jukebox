const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */
//npm run dev om hem te compilen
mix.js('resources/js/app.js', 'public/js')
    .postCss('resources/css/app.css', 'public/css', [ //hoi wat dit doet: haalt app.css uit resources en zet hem naar public
        //
    ]);
