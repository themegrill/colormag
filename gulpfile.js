'use strict';

var gulp         = require( 'gulp' ),
    browserSync  = require( 'browser-sync' ).create(),
    sass         = require( 'gulp-sass' ),
    postcss      = require( 'gulp-postcss' ),
    autoprefixer = require( 'autoprefixer' ),
    notify       = require( 'gulp-notify' ),
    uglifycss    = require( 'gulp-uglifycss' ),
    rename       = require( 'gulp-rename' ),
    concatCss    = require( 'gulp-concat-css' ),
    concatJS     = require( 'gulp-concat' ),
	uglify       = require( 'gulp-uglify' );

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
		scss      : {
			src  : './inc/customizer/custom-controls/**/*.scss',
			dest : './'
		},
		cssconcat : {
			src  : [
				'./inc/customizer/custom-controls/**/*.css',
				'!./inc/customizer/custom-controls/assets/css/*.css',
				'!./inc/customizer/custom-controls/assets/css/*.min.css'
			],
			dest : './inc/customizer/custom-controls/assets/css'
		},
		cssmin    : {
			src  : [
				'./inc/customizer/custom-controls/assets/css/*.css',
				'!./inc/customizer/custom-controls/assets/css/*.min.css'
			],
			dest : './inc/customizer/custom-controls/assets/css'
		},
		js        : {
			src  : [
				'./inc/customizer/custom-controls/**/*.js',
				'!./inc/customizer/custom-controls/assets/js/**/*.js'
			],
			dest : './inc/customizer/custom-controls/assets/js/controls/'
		},
		jsconcat  : {
			src  : './inc/customizer/custom-controls/assets/js/controls/*.js',
			dest : './inc/customizer/custom-controls/assets/js/'
		},
		jsmin     : {
			src  : [
				'./inc/customizer/custom-controls/assets/js/*.js',
				'!./inc/customizer/custom-controls/assets/css/*.min.js'
			],
			dest : './inc/customizer/custom-controls/assets/js'
		}
	}

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
		.src( paths.customizeControls.scss.src, { base: './' } )
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

// Concat customize control styles.
function concatControlCSS() {
	return gulp
		.src( paths.customizeControls.cssconcat.src )
		.pipe( concatCss( 'customize-controls.css' ) )
		.pipe( gulp.dest( paths.customizeControls.cssconcat.dest ) );
}

// Minify customize control css file.
function minifyControlCSS() {
	return gulp
		.src( paths.customizeControls.cssmin.src )
		.pipe( uglifycss() )
		.pipe( rename( { suffix : '.min' } ) )
		.pipe( gulp.dest( paths.customizeControls.cssmin.dest ) );
}

// Copy customize control JS.
function copyControlJS() {
	return gulp
		.src( paths.customizeControls.js.src )
		.pipe( flatten( { subPath : [ 0, - 1 ] } ) )
		.pipe( gulp.dest( paths.customizeControls.js.dest ) );
}

// Concat customize control JS.
function concatControlJS() {
	return gulp
		.src( paths.customizeControls.jsconcat.src )
		.pipe( concatJS( 'customize-controls.js' ) )
		.pipe( gulp.dest( paths.customizeControls.jsconcat.dest ) );
}

// Minifies the js files.
function minifyControlJs() {
	return gulp
		.src( paths.customizeControls.jsmin.src )
		.pipe( uglify() )
		.pipe( rename( { suffix : '.min' } ) )
		.pipe( gulp.dest( paths.customizeControls.jsmin.dest ) )
		.on( 'error', notify.onError() );
}

// Watch for file changes.
function watch() {
	gulp.watch( paths.styles.src, sassCompile );
	gulp.watch( paths.elementorStyles.src, elementorStylesCompile );
	gulp.watch( paths.customizeControls.scss.src, compileControlSass );
	gulp.watch( paths.customizeControls.cssconcat.src, concatControlCSS );
	gulp.watch( paths.customizeControls.cssmin.src, minifyControlCSS );
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
exports.concatControlCSS       = concatControlCSS;
exports.concatControlJS        = concatControlJS;
exports.copyControlJS          = copyControlJS;
exports.minifyControlJs        = minifyControlJs;
