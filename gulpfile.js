'use strict';

var gulp         = require( 'gulp' ),
    browserSync  = require( 'browser-sync' ).create(),
    sass         = require( 'gulp-sass' ),
    postcss      = require( 'gulp-postcss' ),
    autoprefixer = require( 'autoprefixer' ),
    notify       = require( 'gulp-notify' ),
    uglifycss    = require( 'gulp-uglifycss' ),
    rename       = require( 'gulp-rename' ),
    flatten      = require( 'gulp-flatten' ),
    concatCss    = require( 'gulp-concat-css' ),
    concatJS     = require( 'gulp-concat' ),
    uglify       = require( 'gulp-uglify-es' ).default,
    rtlcss       = require( 'gulp-rtlcss' ),
    lec          = require( 'gulp-line-ending-corrector' );

// Define paths.
var paths = {

	styles : {
		src  : './assets/sass/**/*.scss',
		dest : './'
	},

	js : {
		src  : [
			'assets/js/*.js',
			'!assets/js/*.min.js',
			'assets/js/**/*.js',
			'!assets/js/**/*.min.js'
		],
		dest : 'assets/js/'
	},

	customizePreviewJS : {
		src : [
			'./inc/customizer/assets/js/*.js',
			'!./inc/customizer/assets/js/*.min.js',
		],
		dest : './inc/customizer/assets/js/',
	},

	elementorStyles : {
		scss : {
			src  : './inc/elementor/assets/SCSS/**/*.scss',
			dest : './inc/elementor/assets/css/'
		},
		cssmin : {
			src  : [
				'./inc/elementor/assets/css/*.css',
				'!./inc/elementor/assets/css/*.min.css',
				'!./inc/elementor/assets/css/*-rtl.css'
			],
			dest : './inc/elementor/assets/css/'
		}
	},

	elementorJS : {
		jsmin : {
			src  : [
				'./inc/elementor/assets/js/**/*.js',
				'!./inc/elementor/assets/js/**/*.min.js'
			],
			dest : './inc/elementor/assets/js/'
		}
	},

	metaBoxes : {
		scss      : {
			src  : './inc/meta-boxes/assets/scss/*.scss',
			dest : './inc/meta-boxes/assets/css'
		},
		cssmin    : {
			src  : [
				'./inc/meta-boxes/assets/css/*.css',
				'!./inc/meta-boxes/assets/css/*.min.css',
				'!./inc/meta-boxes/assets/css/*-rtl.css'
			],
			dest : './inc/meta-boxes/assets/css'
		},
		jsmin     : {
			src  : [
				'./inc/meta-boxes/assets/js/*.js',
				'!./inc/meta-boxes/assets/js/*.min.js'
			],
			dest : './inc/meta-boxes/assets/js'
		}
	},

	rtlcss : {
		style             : {
			src  : [ './style.css' ],
			dest : './'
		},
		blockStyle        : {
			src  : [ './style-editor-block.css' ],
			dest : './'
		},
		elementorStyles   : {
			src  : [
				'./inc/compatibility/elementor/assets/css/elementor.css',
				'./inc/compatibility/elementor/assets/css/elementor.min.css'
			],
			dest : './inc/compatibility/elementor/assets/css'
		},
		metaBoxes         : {
			src  : [
				'./inc/meta-boxes/assets/css/meta-boxes.css',
				'./inc/meta-boxes/assets/css/meta-boxes.min.css'
			],
			dest : './inc/meta-boxes/assets/css'
		}
	}

};

// Start browserSync.
function browserSyncStart( cb ) {
	browserSync.init( {
		proxy : 'colormag.local/colormag'
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
	           .pipe( postcss( [
		           autoprefixer( {
			           browsers : [ 'last 2 versions' ],
			           cascade  : false
		           } )
	           ] ) )
	           .pipe( lec( { verbose : true, eolc : 'LF', encoding : 'utf8' } ) )
	           .pipe( gulp.dest( paths.styles.dest ) );
}

function elementorStylesCompile() {
	return gulp.src( paths.elementorStyles.scss.src )
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
	           .pipe( lec( { verbose : true, eolc : 'LF', encoding : 'utf8' } ) )
	           .pipe( gulp.dest( paths.elementorStyles.scss.dest ) );
}

// Minifies the elementor js files.
function minifyelementorJs() {
	return gulp
		.src( paths.elementorJS.jsmin.src )
		.pipe( uglify() )
		.pipe( rename( { suffix : '.min' } ) )
		.pipe( lec( { verbose : true, eolc : 'LF', encoding : 'utf8' } ) )
		.pipe( gulp.dest( paths.elementorJS.jsmin.dest ) )
		.on( 'error', notify.onError() );
}

// Minify elementor styles css file.
function minifyelementorStyles() {
	return gulp
		.src( paths.elementorStyles.cssmin.src )
		.pipe( uglifycss() )
		.pipe( rename( { suffix : '.min' } ) )
		.pipe( lec( { verbose : true, eolc : 'LF', encoding : 'utf8' } ) )
		.pipe( gulp.dest( paths.elementorStyles.cssmin.dest ) );
}

// Minifies the js files.
function minifyJs() {
	return gulp
		.src( paths.js.src )
		.pipe( uglify() )
		.pipe( rename( { suffix : '.min' } ) )
		.pipe( lec( { verbose : true, eolc : 'LF', encoding : 'utf8' } ) )
		.pipe( gulp.dest( paths.js.dest ) )
		.on( 'error', notify.onError() );
}

// Minifies the customizer js files.
function minifyCustomizerJs() {
	return gulp
		.src( paths.customizePreviewJS.src )
		.pipe( uglify() )
		.pipe( rename( { suffix : '.min' } ) )
		.pipe( lec( { verbose : true, eolc : 'LF', encoding : 'utf8' } ) )
		.pipe( gulp.dest( paths.customizePreviewJS.dest ) )
		.on( 'error', notify.onError() );
}

// Compile meta boxes styles.
function compileMetaBoxSass() {
	return gulp
		.src( paths.metaBoxes.scss.src )
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
		.pipe( lec( { verbose : true, eolc : 'LF', encoding : 'utf8' } ) )
		.pipe( gulp.dest( paths.metaBoxes.scss.dest ) )
		.on( 'error', notify.onError() );
}

// Minify meta box css file.
function minifyMetaBoxCSS() {
	return gulp
		.src( paths.metaBoxes.cssmin.src )
		.pipe( uglifycss() )
		.pipe( rename( { suffix : '.min' } ) )
		.pipe( lec( { verbose : true, eolc : 'LF', encoding : 'utf8' } ) )
		.pipe( gulp.dest( paths.metaBoxes.cssmin.dest ) );
}

// Minifies the metabox js files.
function minifyMetaBoxJs() {
	return gulp
		.src( paths.metaBoxes.jsmin.src )
		.pipe( uglify() )
		.pipe( rename( { suffix : '.min' } ) )
		.pipe( lec( { verbose : true, eolc : 'LF', encoding : 'utf8' } ) )
		.pipe( gulp.dest( paths.metaBoxes.jsmin.dest ) )
		.on( 'error', notify.onError() );
}

// Generates RTL CSS file.
function generateRTLCSS() {
	return gulp
		.src( paths.rtlcss.style.src )
		.pipe( rtlcss() )
		.pipe( rename( { suffix: '-rtl' } ) )
		.pipe( lec( { verbose : true, eolc : 'LF', encoding : 'utf8' } ) )
		.pipe( gulp.dest( paths.rtlcss.style.dest ) )
		.on( 'error', notify.onError() );
}

// Generates Block Style RTL CSS file.
function generateBlockStyleRTLCSS() {
	return gulp
		.src( paths.rtlcss.blockStyle.src )
		.pipe( rtlcss() )
		.pipe( rename( { suffix: '-rtl' } ) )
		.pipe( lec( { verbose : true, eolc : 'LF', encoding : 'utf8' } ) )
		.pipe( gulp.dest( paths.rtlcss.blockStyle.dest ) )
		.on( 'error', notify.onError() );
}

// Generates Elementor RTL CSS file.
function generateElementorRTLCSS() {
	return gulp
		.src( paths.rtlcss.elementorStyles.src )
		.pipe( rtlcss() )
		.pipe( rename( { suffix: '-rtl' } ) )
		.pipe( lec( { verbose : true, eolc : 'LF', encoding : 'utf8' } ) )
		.pipe( gulp.dest( paths.rtlcss.elementorStyles.dest ) )
		.on( 'error', notify.onError() );
}

// Generates Meta Boxes RTL CSS file.
function generateMetaBoxesRTLCSS() {
	return gulp
		.src( paths.rtlcss.metaBoxes.src )
		.pipe( rtlcss() )
		.pipe( rename( { suffix: '-rtl' } ) )
		.pipe( lec( { verbose : true, eolc : 'LF', encoding : 'utf8' } ) )
		.pipe( gulp.dest( paths.rtlcss.metaBoxes.dest ) )
		.on( 'error', notify.onError() );
}

// Watch for file changes.
function watch() {
	gulp.watch( paths.styles.src, sassCompile );
	gulp.watch( paths.elementorStyles.scss.src, elementorStylesCompile );
	gulp.watch( paths.elementorStyles.cssmin.src, minifyelementorStyles );
	gulp.watch( paths.elementorJS.jsmin.src, minifyelementorJs );
	gulp.watch( paths.js.src, minifyJs );
	gulp.watch( paths.js.src, minifyCustomizerJs );
	gulp.watch( paths.metaBoxes.scss.src, compileMetaBoxSass );
	gulp.watch( paths.metaBoxes.cssmin.src, minifyMetaBoxCSS );
	gulp.watch( paths.metaBoxes.jsmin.src, minifyMetaBoxJs );
	gulp.watch( paths.rtlcss.style.src, generateRTLCSS );
	gulp.watch( paths.rtlcss.blockStyle.src, generateBlockStyleRTLCSS );
	gulp.watch( paths.rtlcss.elementorStyles.src, generateElementorRTLCSS );
	gulp.watch( paths.rtlcss.metaBoxes.src, generateMetaBoxesRTLCSS );
}

// Define series of tasks.
var server            = gulp.series( browserSyncStart, watch ),
    styles            = gulp.series( sassCompile, generateRTLCSS, generateBlockStyleRTLCSS ),
    scripts           = gulp.series( minifyJs ),
    elementorStyles   = gulp.series( elementorStylesCompile, minifyelementorStyles, minifyelementorJs, generateElementorRTLCSS ),
    metaBoxes         = gulp.series( compileMetaBoxSass, minifyMetaBoxCSS, minifyMetaBoxJs, generateMetaBoxesRTLCSS ),
    compile           = gulp.series( styles, scripts, elementorStyles, metaBoxes );

exports.browserSyncStart                = browserSyncStart;
exports.browserSyncReload               = browserSyncReload;
exports.sassCompile                     = sassCompile;
exports.elementorStylesCompile          = elementorStylesCompile;
exports.minifyelementorStyles           = minifyelementorStyles;
exports.minifyelementorJs               = minifyelementorJs;
exports.watch                           = watch;
exports.server                          = server;
exports.styles                          = styles;
exports.scripts                         = scripts;
exports.elementorStyles                 = elementorStyles;
exports.metaBoxes                       = metaBoxes;
exports.compile                         = compile;
exports.minifyJs                        = minifyJs;
exports.minifyCustomizerJs              = minifyCustomizerJs;
exports.compileMetaBoxSass              = compileMetaBoxSass;
exports.minifyMetaBoxCSS                = minifyMetaBoxCSS;
exports.minifyMetaBoxJs                 = minifyMetaBoxJs;
exports.generateRTLCSS                  = generateRTLCSS;
exports.generateBlockStyleRTLCSS        = generateBlockStyleRTLCSS;
exports.generateElementorRTLCSS         = generateElementorRTLCSS;
exports.generateMetaBoxesRTLCSS         = generateMetaBoxesRTLCSS;
