import gulp from 'gulp';
import autoprefixer from 'gulp-autoprefixer';
import lec from 'gulp-line-ending-corrector';
import notify from 'gulp-notify';
import rename from 'gulp-rename';
import rtlcss from 'gulp-rtlcss';
import gulpSass from 'gulp-sass';
import _uglify from 'gulp-uglify-es';
import uglifycss from 'gulp-uglifycss';
import zip from 'gulp-zip';
import * as dartSass from 'sass';
const sass = gulpSass(dartSass);
const uglify = _uglify.default;

// Project information.
const info = {
	name: 'colormag',
	slug: 'colormag',
	url: 'https://themegrill.com/themes/colormag/',
	author: 'ThemeGrill',
	authorUrl: 'https://themegrill.com/',
	authorEmail: 'themegrill@gmail.com',
	teamEmail: 'team@themegrill.com',
};

const dirs = {
	js: 'js',
	css: 'css',
};

// Define paths.
const paths = {
	styles: {
		src: './assets/sass/**/*.scss',
		dest: './',
	},

	adminStyles: {
		src: './inc/admin/sass/*.scss',
		dest: './inc/admin/css/',
	},

	js: {
		src: [
			'./assets/js/*.js',
			'!./assets/js/*.min.js',
			'./assets/js/**/*.js',
			'!./assets/js/**/*.min.js',
		],
		dest: './assets/js/',
	},

	customizePreviewJS: {
		src: [
			'./inc/customizer/assets/js/*.js',
			'!./inc/customizer/assets/js/*.min.js',
		],
		dest: './inc/customizer/assets/js/',
	},

	elementorStyles: {
		scss: './inc/compatibility/elementor/assets/SCSS/elementor.scss',
		src: [
			'./inc/compatibility/elementor/assets/css/elementor.css',
			'!./inc/compatibility/elementor/assets/css/elementor.min.css',
			'!./inc/compatibility/elementor/assets/css/elementor-rtl.css',
			'!./inc/compatibility/elementor/assets/css/elementor.min-rtl.css',
		],
		dest: './inc/compatibility/elementor/assets/css',
	},

	elementorJS: {
		jsmin: {
			src: [
				'./inc/elementor/assets/js/**/*.js',
				'!./inc/elementor/assets/js/**/*.min.js',
			],
			dest: './inc/elementor/assets/js/',
		},
	},

	metaBoxes: {
		scss: {
			src: './inc/meta-boxes/assets/scss/*.scss',
			dest: './inc/meta-boxes/assets/css',
		},
		cssmin: {
			src: [
				'./inc/meta-boxes/assets/css/*.css',
				'!./inc/meta-boxes/assets/css/*.min.css',
				'!./inc/meta-boxes/assets/css/*-rtl.css',
			],
			dest: './inc/meta-boxes/assets/css',
		},
		jsmin: {
			src: [
				'./inc/meta-boxes/assets/js/*.js',
				'!./inc/meta-boxes/assets/js/*.min.js',
			],
			dest: './inc/meta-boxes/assets/js',
		},
	},

	rtlcss: {
		style: {
			src: ['./style.css'],
			dest: './',
		},
		woocommerceStyle: {
			src: ['./woocommerce.css'],
			dest: './',
		},
		blockStyle: {
			src: ['./style-editor-block.css'],
			dest: './',
		},
		elementorStyles: {
			src: [
				'./inc/compatibility/elementor/assets/css/elementor.css',
				'./inc/compatibility/elementor/assets/css/elementor.min.css',
			],
			dest: './inc/compatibility/elementor/assets/css',
		},
		metaBoxes: {
			src: [
				'./inc/meta-boxes/assets/css/meta-boxes.css',
				'./inc/meta-boxes/assets/css/meta-boxes.min.css',
			],
			dest: './inc/meta-boxes/assets/css',
		},
	},

	zip: {
		src: [
			'**',
			'!assets/sass/**',
			'!.*',
			'!*.md',
			'!vendor/**',
			'!*.zip',
			'!.*/**',
			'!dist/**',
			'!bower.json',
			'!gulpfile.js',
			'!gulpfile.mjs',
			'!Gruntfile.js',
			'!package.json',
			'!node_modules/**',
			'!package-lock.json',
			// Dev-only sources & tooling — not needed by the shipped theme.
			'!src/**',
			'!docs/**',
			'!pnpm-lock.yaml',
			'!composer.json',
			'!composer.lock',
			'!webpack.config.js',
			'!tailwind.config.js',
			'!postcss.config.js',
			'!tsconfig.json',
		],
		dest: './dist',
	},
};

// Compiles SASS into CSS.
function sassCompile() {
	return gulp
		.src(paths.styles.src)
		.pipe(
			sass({
				indentType: 'tab',
				indentWidth: 1,
				outputStyle: 'expanded',
			}),
		)
		.pipe(autoprefixer())
		.pipe(lec({ verbose: true, eolc: 'LF', encoding: 'utf8' }))
		.pipe(gulp.dest(paths.styles.dest));
}

// Compiles Admin SASS into CSS.
function adminSassCompile() {
	return gulp
		.src(paths.adminStyles.src)
		.pipe(
			sass({
				indentType: 'tab',
				indentWidth: 1,
				outputStyle: 'expanded',
			}).on('error', sass.logError),
		)
		.pipe(lec({ verbose: true, eolc: 'LF', encoding: 'utf8' }))
		.pipe(gulp.dest(paths.adminStyles.dest));
}

function elementorStylesCompile() {
	return gulp
		.src(paths.elementorStyles.scss)
		.pipe(
			sass({
				indentType: 'tab',
				indentWidth: 1,
				outputStyle: 'expanded',
			}).on('error', sass.logError),
		)
		.pipe(autoprefixer())
		.pipe(lec({ verbose: true, eolc: 'LF', encoding: 'utf8' }))
		.pipe(gulp.dest(paths.elementorStyles.dest));
}

// Minifies the elementor js files.
async function minifyelementorJs() {
	return gulp
		.src(paths.elementorJS.jsmin.src)
		.pipe(uglify())
		.pipe(rename({ suffix: '.min' }))
		.pipe(lec({ verbose: true, eolc: 'LF', encoding: 'utf8' }))
		.pipe(gulp.dest(paths.elementorJS.jsmin.dest))
		.on('error', notify.onError());
}

// Minify elementor styles css file.
function minifyelementorStyles() {
	return gulp
		.src(paths.elementorStyles.src)
		.pipe(uglifycss())
		.pipe(rename({ suffix: '.min' }))
		.pipe(lec({ verbose: true, eolc: 'LF', encoding: 'utf8' }))
		.pipe(gulp.dest(paths.elementorStyles.dest));
}

// Minifies the customizer js files.
function minifyCustomizerJs() {
	return gulp
		.src(paths.customizePreviewJS.src)
		.pipe(uglify())
		.pipe(rename({ suffix: '.min' }))
		.pipe(lec({ verbose: true, eolc: 'LF', encoding: 'utf8' }))
		.pipe(gulp.dest(paths.customizePreviewJS.dest))
		.on('error', notify.onError());
}

// Compile meta boxes styles.
function compileMetaBoxSass() {
	return gulp
		.src(paths.metaBoxes.scss.src)
		.pipe(
			sass({
				indentType: 'tab',
				indentWidth: 1,
				outputStyle: 'expanded',
			}).on('error', sass.logError),
		)
		.pipe(autoprefixer())
		.pipe(lec({ verbose: true, eolc: 'LF', encoding: 'utf8' }))
		.pipe(gulp.dest(paths.metaBoxes.scss.dest))
		.on('error', notify.onError());
}

// Minify meta box css file.
function minifyMetaBoxCSS() {
	return gulp
		.src(paths.metaBoxes.cssmin.src)
		.pipe(uglifycss())
		.pipe(rename({ suffix: '.min' }))
		.pipe(lec({ verbose: true, eolc: 'LF', encoding: 'utf8' }))
		.pipe(gulp.dest(paths.metaBoxes.cssmin.dest));
}

// Minifies the metabox js files.
function minifyMetaBoxJs() {
	return gulp
		.src(paths.metaBoxes.jsmin.src)
		.pipe(uglify())
		.pipe(rename({ suffix: '.min' }))
		.pipe(lec({ verbose: true, eolc: 'LF', encoding: 'utf8' }))
		.pipe(gulp.dest(paths.metaBoxes.jsmin.dest))
		.on('error', notify.onError());
}

// Generates RTL CSS file.
function generateRTLCSS() {
	return gulp
		.src(paths.rtlcss.style.src)
		.pipe(rtlcss())
		.pipe(rename({ suffix: '-rtl' }))
		.pipe(lec({ verbose: true, eolc: 'LF', encoding: 'utf8' }))
		.pipe(gulp.dest(paths.rtlcss.style.dest))
		.on('error', notify.onError());
}

// Generates Block Style RTL CSS file.
function generateBlockStyleRTLCSS() {
	return gulp
		.src(paths.rtlcss.blockStyle.src)
		.pipe(rtlcss())
		.pipe(rename({ suffix: '-rtl' }))
		.pipe(lec({ verbose: true, eolc: 'LF', encoding: 'utf8' }))
		.pipe(gulp.dest(paths.rtlcss.blockStyle.dest))
		.on('error', notify.onError());
}

// Generates Elementor RTL CSS file.
function generateElementorRTLCSS() {
	return gulp
		.src(paths.rtlcss.elementorStyles.src)
		.pipe(rtlcss())
		.pipe(rename({ suffix: '-rtl' }))
		.pipe(lec({ verbose: true, eolc: 'LF', encoding: 'utf8' }))
		.pipe(gulp.dest(paths.rtlcss.elementorStyles.dest))
		.on('error', notify.onError());
}

// Generates Meta Boxes RTL CSS file.
function generateMetaBoxesRTLCSS() {
	return gulp
		.src(paths.rtlcss.metaBoxes.src)
		.pipe(rtlcss())
		.pipe(rename({ suffix: '-rtl' }))
		.pipe(lec({ verbose: true, eolc: 'LF', encoding: 'utf8' }))
		.pipe(gulp.dest(paths.rtlcss.metaBoxes.dest))
		.on('error', notify.onError());
}

// From grunt

// Compress plugin into a zip file.
function compressZip() {
	return gulp
		.src(paths.zip.src, {
			encoding: false,
		})
		.pipe(
			rename(function (path) {
				path.dirname = info.name + '/' + path.dirname;
			}),
		)
		.pipe(zip(info.name + '.zip'))
		.pipe(gulp.dest(paths.zip.dest));
}

// Minify all .js files.
async function minifyJs() {
	return gulp
		.src(paths.js.src)
		.pipe(uglify())
		.pipe(rename({ suffix: '.min' }))
		.pipe(lec({ verbose: true, eolc: 'LF', encoding: 'utf8' }))
		.pipe(gulp.dest(paths.js.dest))
		.on('error', notify.onError());
}

function watch() {
	gulp.watch(paths.styles.src, sassCompile);
	gulp.watch(paths.styles.src, adminSassCompile);
	gulp.watch('./inc/compatibility/elementor/assets/SCSS/**/*.scss', elementorStylesCompile);
	gulp.watch(paths.elementorStyles.src, minifyelementorStyles);
	gulp.watch(paths.elementorJS.jsmin.src, minifyelementorJs);
	gulp.watch(paths.js.src, minifyJs);
	gulp.watch(paths.js.src, minifyCustomizerJs);
	gulp.watch(paths.metaBoxes.scss.src, compileMetaBoxSass);
	gulp.watch(paths.metaBoxes.cssmin.src, minifyMetaBoxCSS);
	gulp.watch(paths.metaBoxes.jsmin.src, minifyMetaBoxJs);
	gulp.watch(paths.rtlcss.style.src, generateRTLCSS);
	gulp.watch(paths.rtlcss.blockStyle.src, generateBlockStyleRTLCSS);
	gulp.watch(paths.rtlcss.elementorStyles.src, generateElementorRTLCSS);
	gulp.watch(paths.rtlcss.metaBoxes.src, generateMetaBoxesRTLCSS);
}

// Build
const build = gulp.series(
	generateRTLCSS,
	generateBlockStyleRTLCSS,
	generateElementorRTLCSS,
	generateMetaBoxesRTLCSS,
	minifyJs,
	minifyCustomizerJs,
	minifyMetaBoxJs,
	minifyMetaBoxCSS,
	minifyelementorJs,
	minifyelementorStyles,
	sassCompile,
	adminSassCompile,
	elementorStylesCompile,
	compileMetaBoxSass,
	compressZip,
);

// Define series of tasks.
const styles = gulp.series(
		sassCompile,
		generateRTLCSS,
		generateBlockStyleRTLCSS,
	),
	scripts = gulp.series(minifyJs),
	elementorStyles = gulp.series(
		elementorStylesCompile,
		minifyelementorStyles,
		minifyelementorJs,
		generateElementorRTLCSS,
	),
	metaBoxes = gulp.series(
		compileMetaBoxSass,
		minifyMetaBoxCSS,
		minifyMetaBoxJs,
		generateMetaBoxesRTLCSS,
	),
	compile = gulp.series(styles, scripts, elementorStyles, metaBoxes);

export {
	adminSassCompile,
	build,
	compile,
	compileMetaBoxSass,
	compressZip,
	elementorStyles,
	elementorStylesCompile,
	generateBlockStyleRTLCSS,
	generateElementorRTLCSS,
	generateMetaBoxesRTLCSS,
	generateRTLCSS,
	metaBoxes,
	minifyCustomizerJs,
	minifyJs,
	minifyMetaBoxCSS,
	minifyMetaBoxJs,
	minifyelementorJs,
	minifyelementorStyles,
	sassCompile,
	scripts,
	styles,
	watch,
};
