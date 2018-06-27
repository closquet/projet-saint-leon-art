/* closquet/mariam faso
 *
 * /gulpfile.js - Gulp tasks
 */

'use strict';

//--Config--//
const src = {
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


import gulp from 'gulp';
import image from 'gulp-image';
import sass from 'gulp-sass';
import autoprefixer from 'gulp-autoprefixer';
import csso from 'gulp-csso';
import babel from 'gulp-babel';

// --- Task for images

gulp.task( "images", () =>
    gulp.src( src.img + "/**" )
        .pipe( image() )
        .pipe( gulp.dest( "assets/images" ) )
);

// --- Task for styles

gulp.task( "css", () =>
    gulp.src( src.scss + "/**/*.scss" )
        .pipe( sass().on( "error", sass.logError ) )
        .pipe( autoprefixer() )
        .pipe( csso() )
        .pipe( gulp.dest( "assets/css" ) )
);


// --- Task for js

gulp.task( "js", () =>
    gulp.src( src.js + "/**/*.js" )
        .pipe( babel() )
        .pipe( gulp.dest( "assets/js" ) )
);


// --- Watch tasks

gulp.task( "watch", () => {
    gulp.watch( src.img + "/**", [ "images" ] );
    gulp.watch( src.scss + "/**/*.scss", [ "css" ] );
    gulp.watch( src.js + "/**/*.js", [ "js" ] );

    gulp.watch( dest.css + "/**/*.css" );
    gulp.watch( dest.js + "/**/*.js" );
});

// --- Aliases


gulp.task( "default", ['css', 'js'] );
gulp.task( "work", ['default', 'watch'] );
