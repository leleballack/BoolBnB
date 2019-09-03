const mix = require("laravel-mix");

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

mix.js("resources/js/editAptMap.js", "public/js/editAptMap.js")
    .js("resources/js/createAptMap.js", "public/js/createAptMap.js")
    .js("resources/js/app.js", "public/js/app.js");

mix.sass("resources/sass/app.scss", "public/css");

mix.browserSync({
    proxy: "http://127.0.0.1:8000",
    open: true,
    ui: false,
    injectChanges: true,
    notify: false,
    files: [
        "resources/**/*.+(html|php)",
        "public/css/app.css",
        "public/js/app.js"
    ]
});
