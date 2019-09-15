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

mix.js("resources/js/app.js", "public/js/app.js")
    .js("resources/js/editAptMap.js", "public/js/editAptMap.js")
    .js("resources/js/createAptMap.js", "public/js/createAptMap.js")
    .js("resources/js/publicShowAptMap.js", "public/js/publicShowAptMap.js")
    .js("resources/js/aptSearch.js", "public/js/aptSearch.js")
<<<<<<< HEAD
    .js("resources/js/charts.js", "public/js/charts.js")
    .js("resources/js/messages.js", "public/js/messages.js");
=======
    .js("resources/js/charts.js", "public/js/charts.js");
>>>>>>> 3a7cf282887c994b2f6aa381ba56caa31440c42a

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
