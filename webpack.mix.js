const mix = require("laravel-mix");

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

mix.js("resources/js/app.js", "public/js").postCss(
    "resources/css/app.css",
    "public/css",
    [
        //
    ]
);

mix.js("resources/js/adminLte.core.js", "public/js/vendor");

mix.js("resources/js/datatables.js", "public/js/vendor");

mix.postCss("resources/css/adminLte.core.css", "public/css/vendor");
mix.postCss("resources/css/datatables.css", "public/css/vendor");

mix.browserSync("127.0.0.1:8000");
