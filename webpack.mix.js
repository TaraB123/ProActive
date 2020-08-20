const mix = require('laravel-mix');
require('dotenv').config();
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
 
mix.options({
    processCssUrls: false
});
 
if (!mix.inProduction()) {
    mix.webpackConfig({
        devtool: 'source-map'
    })
    .sourceMaps()
}
 
mix.react('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css')
    .sass('resources/sass/homepage.scss', 'public/css/homepage.css')
    .sass('resources/sass/profilepage.scss', 'public/css/profilepage.css')
    .sass('resources/sass/profileedit.scss', 'public/css/profileedit.css')
    .sass('resources/sass/header.scss', 'public/css/header.css')
    .sass('resources/sass/footer.scss', 'public/css/footer.css')
    .sass('resources/sass/activities.scss', 'public/css/activities.css')
    .sass('resources/sass/register.scss', 'public/css/register.css')
    .sass('resources/sass/login.scss', 'public/css/login.css')
    .sass('resources/sass/categories.scss', 'public/css/categories.css')
    .sass('resources/sass/detail.scss', 'public/css/detail.css')
    .sass('resources/sass/create.scss', 'public/css/create.css')
    .sass('resources/sass/search.scss', 'public/css/search.css')
    .sass('resources/sass/editactivity.scss', 'public/css/editactivity.css')
 
    .browserSync({
        host: 'localhost',
        port: 3000,
        proxy: {
            target: process.env.APP_URL // Yay! Using APP_URL from the .env file!
        }
    });
 
// add versioning 
mix.version();