let mix = require('laravel-mix');
const {GenerateSW} = require('workbox-webpack-plugin');

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

mix.js('resources/assets/js/app.js', 'public/js')
   .sass('resources/assets/sass/app.scss', 'public/css')
   .version()
   .sourceMaps();

/*
mix.webpackConfig({
    plugins: [
        new GenerateSW({
            swDest: './public/serviceworker.js',
            importWorkboxFrom: 'local',
            
        })
    ]
})
*/