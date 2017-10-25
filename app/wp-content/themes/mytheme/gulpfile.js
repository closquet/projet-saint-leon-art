/* closquet/mariam faso
 *
 * /gulpfile.js - Gulp tasks
 */

//--Config--//
var src = {
    img: "src/images",
    scss: "src/sass",
    js: "src/js"
},
    dest = {
    img: "assets/images",
    html: ".",
    css: "assets/css",
    js: "assets/js"
};


var gulp = require( "gulp" ),
    image = require( "gulp-image" ),
    sass = require( "gulp-sass" ),
    autoprefixer = require( "gulp-autoprefixer" ),
    csso = require( "gulp-csso" ),
    babel = require( "gulp-babel" );

// --- Task for images

gulp.task( "images", function() {
    gulp.src( src.img + "/**" )
        .pipe( image() )
        .pipe( gulp.dest( "assets/images" ) );
} );

// --- Task for styles

gulp.task( "css", function() {
    gulp.src( src.scss + "/**/*.scss" )
        .pipe( sass().on( "error", sass.logError ) )
        .pipe( autoprefixer() )
        .pipe( csso() )
        .pipe( gulp.dest( "assets/css" ) );
} );

// --- Task for js

gulp.task( "js", function() {
    gulp.src( src.js + "/**/*.js" )
        .pipe( babel() )
        .pipe( gulp.dest( "assets/js" ) );
} );


// --- Watch tasks

gulp.task( "watch", function() {
    gulp.watch( src.img + "/**", [ "images" ] );
    gulp.watch( src.scss + "/**/*.scss", [ "css" ] );
    gulp.watch( src.js + "/**/*.js", [ "js" ] );

    gulp.watch( dest.css + "/**/*.css" );
    gulp.watch( dest.js + "/**/*.js" );
} );

// --- Aliases

gulp.task( "default", [ "css", "js" ] );
gulp.task( "image", [ "images" ] );
gulp.task( "work", [ "default", "watch" ] );
