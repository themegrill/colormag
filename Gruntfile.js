/* jshint node:true */
module.exports = function( grunt ){
	'use strict';

	grunt.initConfig({

		// Setting folder templates.
		dirs: {
			js: 'js',
			css: 'css'
		},

		// JavaScript linting with JSHint.
		jshint: {
			options: {
				jshintrc: '.jshintrc'
			},
			all: [
				'Gruntfile.js',
				'<%= dirs.js %>/*.js',
				'!<%= dirs.js %>/*.min.js',
            '!<%= dirs.js %>/fitvids/jquery.fitvids.js',
            '!<%= dirs.js %>/magnific-popup/jquery.magnific-popup.js',
            '!<%= dirs.js %>/news-ticker/jquery.newsTicker.js',
            '!<%= dirs.js %>/sticky/jquery.sticky.js',
            '!<%= dirs.js %>/html5shiv.js',
            '!<%= dirs.js %>/image-uploader.js',
            '!<%= dirs.js %>/jquery.bxslider.js',
            '!<%= dirs.js %>/navigation.js'
			]
		},

		// Generate POT files.
		makepot: {
			options: {
				type: 'wp-theme',
				domainPath: 'languages',
				potHeaders: {
					'report-msgid-bugs-to': 'themegrill@gmail.com',
					'language-team': 'LANGUAGE <EMAIL@ADDRESS>'
				}
			},
			dist: {
				options: {
					potFilename: 'colormag.pot',
					exclude: [
						'deploy/.*' // Exclude deploy directory
					]
				}
			}
		},

		// Check textdomain errors.
		checktextdomain: {
			options: {
				text_domain: 'colormag',
				keywords: [
					'__:1,2d',
					'_e:1,2d',
					'_x:1,2c,3d',
					'esc_html__:1,2d',
					'esc_html_e:1,2d',
					'esc_html_x:1,2c,3d',
					'esc_attr__:1,2d',
					'esc_attr_e:1,2d',
					'esc_attr_x:1,2c,3d',
					'_ex:1,2c,3d',
					'_n:1,2,4d',
					'_nx:1,2,4c,5d',
					'_n_noop:1,2,3d',
					'_nx_noop:1,2,3c,4d'
				]
			},
			files: {
				src: [
					'**/*.php',
					'!node_modules/**'
				],
				expand: true
			}
		}

	});

	// Load NPM tasks to be used here
	grunt.loadNpmTasks( 'grunt-wp-i18n' );
	grunt.loadNpmTasks( 'grunt-checktextdomain' );
	grunt.loadNpmTasks( 'grunt-contrib-jshint' );

	// Register tasks
	grunt.registerTask( 'default', [
		'jshint'
	]);

	grunt.registerTask( 'dev', [
		'default',
		'makepot'
	]);
};
