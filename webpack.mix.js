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

mix.js('resources/js/app.js', 'public/js')
.react()
    .sass('resources/sass/app.scss', 'public/css');

// $('#frmComments').on('submit', function(e) {
//     e.preventDefault();
//     var body = $('#bodyComment').val();
//     var mediaid = $('#mediaid').val();
//     var userid = $('#userid').val();
//     $.ajax({
//         type: "POST",
//         url: 'http://cafetawa01.app/comments',
//         data: { body: bodyComment, mediaid: mediaid, userid: userid },
//         success: function(msg) {
//             $("body").append("<div>" + msg + "</div>");
//             location.reload();
//         }
//     });
// });