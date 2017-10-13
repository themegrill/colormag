'use strict';

var gulp            = require( 'gulp' );
var browserSync     = require('browser-sync').create();
var sass            = require( 'gulp-sass' );

// Define paths
var paths = {
    styles: {
        src: './SCSS/**/*.scss',
        dest: './'
    },
    js: {
        src: './js/*.js',
        dest: './js/'
    }
};

// Start browserSync
function browserSyncStart( cb ) {
    browserSync.init({
        proxy:'localhost/colormag'
    }, cb);
}

// Reloads the browser
function browserSyncReload( cb ) {
    browserSync.reload();
    cb();
}

// Compiles SASS into CSS
function sassCompile() {
    return gulp.src( paths.styles.src )
        .pipe( sass({
            indentType: 'tab',
            indentWidth: 1,
            outputStyle: 'expanded'
        } ).on( 'error', sass.logError) )
        .pipe( gulp.dest( paths.styles.dest ) )
        .pipe( browserSync.stream() );
}

// Watch for file changes
function watch() {
    gulp.watch( paths.styles.src, sassCompile );
    gulp.watch( paths.js.src, browserSyncReload );
}


// define series of tasks
var server = gulp.series( browserSyncStart, watch );

exports.browserSyncStart = browserSyncStart;
exports.browserSyncReload = browserSyncReload;
exports.sassCompile = sassCompile;
exports.watch = watch;
exports.server = server;