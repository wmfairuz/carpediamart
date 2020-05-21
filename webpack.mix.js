const mix = require('laravel-mix');
require('laravel-mix-purgecss');

mix.sass('resources/sass/app.scss', 'public/css');
mix.sass('resources/sass/detail-page-delivery.scss', 'public/css');
mix.sass('resources/sass/booking-sign_up.scss', 'public/css');
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
        /sticky/
    ]
});
