const mix = require('laravel-mix');
require('laravel-mix-purgecss');

mix.sass('resources/sass/app.scss', 'public/css');
mix.sass('resources/sass/detail-page-delivery.scss', 'public/css');
mix.sass('resources/sass/booking-sign_up.scss', 'public/css');
mix.copyDirectory('resources/sass/icon_fonts', 'public/css/icon_fonts');
mix.copyDirectory('resources/sass/images', 'public/css/images');
mix.copyDirectory('resources/img', 'public/img');
mix.copyDirectory('resources/images', 'public/images');
mix.version();
mix.purgeCss({
    enabled: true,
    extensions: ['blade.php', 'vue', 'js', 'php'],
    whitelistPatterns: [
        /modal/,
        /tooltip/,
        /dropdown/,
        /announcekit/,
        /swal2/,
        /recaptcha/,
        /dropdown/,
        /notie/,
        /check-mark/,
        /slider/,
        /caret/,
        /rc-ln/,
        /sticky/,
        /owl/
    ]
});
