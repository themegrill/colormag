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
    uglify       = require( 'gulp-uglify' ),
    rtlcss       = require( 'gulp-rtlcss' );

// Define paths.
var paths = {

	styles : {
		src  : './SCSS/**/*.scss',
		dest : './'
	},

	js : {
		src  : [
			'./js/*.js',
			'!./js/*.min.js',
			'./js/**/*.js',
			'!./js/**/*.min.js'
		],
		dest : './js/'
	},

	elementorStyles : {
		scss : {
			src  : './inc/elementor/assets/SCSS/**/*.scss',
			dest : './inc/elementor/assets/css/'
		},
		cssmin : {
			src  : [
				'./inc/elementor/assets/css/*.css',
				'!./inc/elementor/assets/css/*.min.css'
			],
			dest : './inc/elementor/assets/css/'
		}
	},

	extendCustomize : {
		scss      : {
			src  : './inc/customizer/assets/scss/**/*.scss',
			dest : './inc/customizer/assets/css'
		},
		cssmin    : {
			src  : [
				'./inc/customizer/assets/css/*.css',
				'!./inc/customizer/assets/css/*.min.css'
			],
			dest : './inc/customizer/assets/css'
		},
		jsmin     : {
			src  : [
				'./inc/customizer/assets/js/*.js',
				'!./inc/customizer/assets/js/*.min.js'
			],
			dest : './inc/customizer/assets/js'
		}
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
		jsconcat  : {
			src  : [
				'./inc/customizer/custom-controls/**/*.js',
				'!./inc/customizer/custom-controls/assets/js/*.js',
				'!./inc/customizer/custom-controls/assets/js/*.min.js'
			],
			dest : './inc/customizer/custom-controls/assets/js/'
		},
		jsmin     : {
			src  : [
				'./inc/customizer/custom-controls/assets/js/*.js',
				'!./inc/customizer/custom-controls/assets/js/*.min.js'
			],
			dest : './inc/customizer/custom-controls/assets/js'
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
				'!./inc/meta-boxes/assets/css/*.min.css'
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
		extendCustomize   : {
			src  : [
				'./inc/customizer/assets/css/extend-customizer.css',
				'./inc/customizer/assets/css/extend-customizer.min.css'
			],
			dest : './inc/customizer/assets/css'
		},
		customizeControls : {
			src  : [
				'./inc/customizer/custom-controls/assets/css/customize-controls.css',
				'./inc/customizer/custom-controls/assets/css/customize-controls.min.css'
			],
			dest : './inc/customizer/custom-controls/assets/css'
		},
		elementorStyles   : {
			src  : [
				'./inc/elementor/assets/css/elementor.css',
				'./inc/elementor/assets/css/elementor.min.css'
			],
			dest : './inc/elementor/assets/css'
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
	           .pipe( gulp.dest( paths.elementorStyles.scss.dest ) );
}

// Minify elementor styles css file.
function minifyelementorStyles() {
	return gulp
		.src( paths.elementorStyles.cssmin.src )
		.pipe( uglifycss() )
		.pipe( rename( { suffix : '.min' } ) )
		.pipe( gulp.dest( paths.elementorStyles.cssmin.dest ) );
}

// Compile extend customizer styles.
function compileExtendCustomizerSass() {
	return gulp
		.src( paths.extendCustomize.scss.src )
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
		.pipe( gulp.dest( paths.extendCustomize.scss.dest ) )
		.on( 'error', notify.onError() );
}

// Minify extend customizer css file.
function minifyExtendCustomizerCSS() {
	return gulp
		.src( paths.extendCustomize.cssmin.src )
		.pipe( uglifycss() )
		.pipe( rename( { suffix : '.min' } ) )
		.pipe( gulp.dest( paths.extendCustomize.cssmin.dest ) );
}

// Minifies the extend customizer js files.
function minifyExtendCustomizerJs() {
	return gulp
		.src( paths.extendCustomize.jsmin.src )
		.pipe( uglify() )
		.pipe( rename( { suffix : '.min' } ) )
		.pipe( gulp.dest( paths.extendCustomize.jsmin.dest ) )
		.on( 'error', notify.onError() );
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

// Concat customize control JS.
function concatControlJS() {
	return gulp
		.src( paths.customizeControls.jsconcat.src )
		.pipe( concatJS( 'customize-controls.js' ) )
		.pipe( gulp.dest( paths.customizeControls.jsconcat.dest ) );
}

// Minifies the customize control js files.
function minifyControlJs() {
	return gulp
		.src( paths.customizeControls.jsmin.src )
		.pipe( uglify() )
		.pipe( rename( { suffix : '.min' } ) )
		.pipe( gulp.dest( paths.customizeControls.jsmin.dest ) )
		.on( 'error', notify.onError() );
}

// Minifies the js files.
function minifyJs() {
	return gulp
		.src( paths.js.src )
		.pipe( uglify() )
		.pipe( rename( { suffix : '.min' } ) )
		.pipe( gulp.dest( paths.js.dest ) )
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
		.pipe( gulp.dest( paths.metaBoxes.scss.dest ) )
		.on( 'error', notify.onError() );
}

// Minify meta box css file.
function minifyMetaBoxCSS() {
	return gulp
		.src( paths.metaBoxes.cssmin.src )
		.pipe( uglifycss() )
		.pipe( rename( { suffix : '.min' } ) )
		.pipe( gulp.dest( paths.metaBoxes.cssmin.dest ) );
}

// Minifies the metabox js files.
function minifyMetaBoxJs() {
	return gulp
		.src( paths.metaBoxes.jsmin.src )
		.pipe( uglify() )
		.pipe( rename( { suffix : '.min' } ) )
		.pipe( gulp.dest( paths.metaBoxes.jsmin.dest ) )
		.on( 'error', notify.onError() );
}

// Generates RTL CSS file.
function generateRTLCSS() {
	return gulp
		.src( paths.rtlcss.style.src )
		.pipe( rtlcss() )
		.pipe( rename( { suffix: '-rtl' } ) )
		.pipe( gulp.dest( paths.rtlcss.style.dest ) )
		.on( 'error', notify.onError() );
}

// Generates Extend Customize RTL CSS file.
function generateExtendCustomizeRTLCSS() {
	return gulp
		.src( paths.rtlcss.extendCustomize.src )
		.pipe( rtlcss() )
		.pipe( rename( { suffix: '-rtl' } ) )
		.pipe( gulp.dest( paths.rtlcss.extendCustomize.dest ) )
		.on( 'error', notify.onError() );
}

// Generates Customize Controls RTL CSS file.
function generateCustomizeControlsRTLCSS() {
	return gulp
		.src( paths.rtlcss.customizeControls.src )
		.pipe( rtlcss() )
		.pipe( rename( { suffix: '-rtl' } ) )
		.pipe( gulp.dest( paths.rtlcss.customizeControls.dest ) )
		.on( 'error', notify.onError() );
}

// Generates Elementor RTL CSS file.
function generateElementorRTLCSS() {
	return gulp
		.src( paths.rtlcss.elementorStyles.src )
		.pipe( rtlcss() )
		.pipe( rename( { suffix: '-rtl' } ) )
		.pipe( gulp.dest( paths.rtlcss.elementorStyles.dest ) )
		.on( 'error', notify.onError() );
}

// Generates Meta Boxes RTL CSS file.
function generateMetaBoxesRTLCSS() {
	return gulp
		.src( paths.rtlcss.metaBoxes.src )
		.pipe( rtlcss() )
		.pipe( rename( { suffix: '-rtl' } ) )
		.pipe( gulp.dest( paths.rtlcss.metaBoxes.dest ) )
		.on( 'error', notify.onError() );
}

// Watch for file changes.
function watch() {
	gulp.watch( paths.styles.src, sassCompile );
	gulp.watch( paths.elementorStyles.scss.src, elementorStylesCompile );
	gulp.watch( paths.elementorStyles.cssmin.src, minifyelementorStyles );
	gulp.watch( paths.extendCustomize.scss.src, compileExtendCustomizerSass );
	gulp.watch( paths.extendCustomize.cssmin.src, minifyExtendCustomizerCSS );
	gulp.watch( paths.extendCustomize.jsmin.src, minifyExtendCustomizerJs );
	gulp.watch( paths.customizeControls.scss.src, compileControlSass );
	gulp.watch( paths.customizeControls.cssconcat.src, concatControlCSS );
	gulp.watch( paths.customizeControls.cssmin.src, minifyControlCSS );
	gulp.watch( paths.customizeControls.jsconcat.src, concatControlJS );
	gulp.watch( paths.customizeControls.jsmin.src, minifyControlJs );
	gulp.watch( paths.js.src, minifyJs );
	gulp.watch( paths.metaBoxes.scss.src, compileMetaBoxSass );
	gulp.watch( paths.metaBoxes.cssmin.src, minifyMetaBoxCSS );
	gulp.watch( paths.metaBoxes.jsmin.src, minifyMetaBoxJs );
	gulp.watch( paths.rtlcss.style.src, generateRTLCSS );
	gulp.watch( paths.rtlcss.extendCustomize.src, generateExtendCustomizeRTLCSS );
	gulp.watch( paths.rtlcss.customizeControls.src, generateCustomizeControlsRTLCSS );
	gulp.watch( paths.rtlcss.elementorStyles.src, generateElementorRTLCSS );
	gulp.watch( paths.rtlcss.metaBoxes.src, generateMetaBoxesRTLCSS );
}


// Define series of tasks.
var server = gulp.series( browserSyncStart, watch );

exports.browserSyncStart                = browserSyncStart;
exports.browserSyncReload               = browserSyncReload;
exports.sassCompile                     = sassCompile;
exports.elementorStylesCompile          = elementorStylesCompile;
exports.minifyelementorStyles           = minifyelementorStyles;
exports.watch                           = watch;
exports.server                          = server;
exports.compileExtendCustomizerSass     = compileExtendCustomizerSass;
exports.minifyExtendCustomizerCSS       = minifyExtendCustomizerCSS;
exports.minifyExtendCustomizerJs        = minifyExtendCustomizerJs;
exports.compileControlSass              = compileControlSass;
exports.minifyControlCSS                = minifyControlCSS;
exports.concatControlCSS                = concatControlCSS;
exports.concatControlJS                 = concatControlJS;
exports.minifyControlJs                 = minifyControlJs;
exports.minifyJs                        = minifyJs;
exports.compileMetaBoxSass              = compileMetaBoxSass;
exports.minifyMetaBoxCSS                = minifyMetaBoxCSS;
exports.minifyMetaBoxJs                 = minifyMetaBoxJs;
exports.generateRTLCSS                  = generateRTLCSS;
exports.generateExtendCustomizeRTLCSS   = generateExtendCustomizeRTLCSS;
exports.generateCustomizeControlsRTLCSS = generateCustomizeControlsRTLCSS;
exports.generateElementorRTLCSS         = generateElementorRTLCSS;
exports.generateMetaBoxesRTLCSS         = generateMetaBoxesRTLCSS;
