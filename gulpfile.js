'use strict';

var gulp         = require( 'gulp' ),
    browserSync  = require( 'browser-sync' ).create(),
    sass         = require( 'gulp-sass' ),
    postcss      = require( 'gulp-postcss' ),
    autoprefixer = require( 'autoprefixer' ),
    notify       = require( 'gulp-notify' ),
    uglifycss    = require( 'gulp-uglifycss' ),
    rename       = require( 'gulp-rename' );

// Define paths.
var paths = {

	styles : {
		src  : './SCSS/**/*.scss',
		dest : './'
	},

	js : {
		src  : './js/*.js',
		dest : './js/'
	},

	elementorStyles : {
		src  : './inc/elementor/assets/SCSS/**/*.scss',
		dest : './inc/elementor/assets/css/'
	},

	customizeControls : {
		scss : {
			src  : './inc/customizer/custom-controls/assets/scss/**/*.scss',
			dest : './inc/customizer/custom-controls/assets/css'
		},
		css: {
			src: [ './inc/customizer/custom-controls/assets/css/*.css', '!./inc/customizer/custom-controls/assets/css/*.min.css' ],
			dest: './inc/customizer/custom-controls/assets/css'
		}
	},

};

// Start browserSync.
function browserSyncStart( cb ) {
	browserSync.init( {
		proxy : 'colormag.local'
	}, cb );
}

// Reloads the browser.
function browserSyncReload( cb ) {
	browserSync.reload();
	cb();
}

// Compiles SASS into CSS.
function sassCompile() {
	return gulp.src( paths.styles.src )
	           .pipe( sass( {
		           indentType  : 'tab',
		           indentWidth : 1,
		           outputStyle : 'expanded',
		           linefeed    : 'crlf'
	           } ).on( 'error', sass.logError ) )
	           .pipe( gulp.dest( paths.styles.dest ) );
}

function elementorStylesCompile() {
	return gulp.src( paths.elementorStyles.src )
	           .pipe( sass( {
		           indentType  : 'tab',
		           indentWidth : 1,
		           outputStyle : 'expanded',
		           linefeed    : 'crlf'
	           } ).on( 'error', sass.logError ) )
	           .pipe( postcss( [
		           autoprefixer( {
			           browsers : [ 'last 2 versions' ],
			           cascade  : false
		           } )
	           ] ) )
	           .pipe( gulp.dest( paths.elementorStyles.dest ) );
}

// Compile customize control styles.
function compileControlSass() {
	return gulp
		.src( paths.customizeControls.scss.src )
		.pipe( sass( {
			indentType  : 'tab',
			indentWidth : 1,
			outputStyle : 'expanded',
			linefeed    : 'crlf'
		} ).on( 'error', sass.logError ) )
		.pipe( postcss( [
			autoprefixer( {
				browsers : [ 'last 2 versions' ],
				cascade  : false
			} )
		] ) )
		.pipe( gulp.dest( paths.customizeControls.scss.dest ) )
		.on( 'error', notify.onError() );
}

// Minify customize control css file.
function minifyControlCSS() {
	return gulp
		.src( paths.customizeControls.css.src )
		.pipe( uglifycss() )
		.pipe( rename( { suffix : '.min' } ) )
		.pipe( gulp.dest( paths.customizeControls.css.dest ) );
}

// Watch for file changes.
function watch() {
	gulp.watch( paths.styles.src, sassCompile );
	gulp.watch( paths.elementorStyles.src, elementorStylesCompile );
	gulp.watch( paths.customizeControls.scss.src, compileControlSass );
	gulp.watch( paths.customizeControls.css.src, minifyControlCSS );
}


// Define series of tasks.
var server = gulp.series( browserSyncStart, watch );

exports.browserSyncStart       = browserSyncStart;
exports.browserSyncReload      = browserSyncReload;
exports.sassCompile            = sassCompile;
exports.elementorStylesCompile = elementorStylesCompile;
exports.watch                  = watch;
exports.server                 = server;
exports.compileControlSass     = compileControlSass;
exports.minifyControlCSS       = minifyControlCSS;
