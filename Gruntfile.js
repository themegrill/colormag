/* jshint node:true */
module.exports = function ( grunt ) {
	'use strict';

	grunt.initConfig( {

		// Setting folder templates.
		dirs : {
			js  : 'js',
			css : 'css'
		},

		// JavaScript linting with JSHint.
		jshint : {
			options : {
				jshintrc : '.jshintrc'
			},
			all     : [
				'Gruntfile.js',
				'<%= dirs.js %>/*.js',
				'!<%= dirs.js %>/*.min.js',
				'!<%= dirs.js %>/html5shiv.js',
				'!<%= dirs.js %>/jquery.bxslider.js'
			]
		},

		// Minify all .js files.
		uglify : {
			options  : {
				// Preserve comments that start with a bang.
				preserveComments : /^!/
			},
			frontend : {
				files : [
					{
						expand : true,
						cwd    : '<%= dirs.js %>/',
						src    : [
							'navigation.js',
							'colormag-custom.js',
							'loadmore.js',
							'infinite-scroll.js',
							'skip-link-focus-fix.js'
						],
						dest   : '<%= dirs.js %>/',
						ext    : '.min.js'
					}
				]
			},
			vendor   : {
				files : {
					'<%= dirs.js %>/html5shiv.min.js'                                 : [ '<%= dirs.js %>/html5shiv.js' ],
					'<%= dirs.js %>/jquery.bxslider.min.js'                           : [ '<%= dirs.js %>/jquery.bxslider.js' ],
					'<%= dirs.js %>/sticky/jquery.sticky.min.js'                      : [ '<%= dirs.js %>/sticky/jquery.sticky.js' ],
					'<%= dirs.js %>/fitvids/jquery.fitvids.min.js'                    : [ '<%= dirs.js %>/fitvids/jquery.fitvids.js' ],
					'<%= dirs.js %>/easytabs/jquery.easytabs.min.js'                  : [ '<%= dirs.js %>/easytabs/jquery.easytabs.js' ],
					'<%= dirs.js %>/news-ticker/jquery.newsTicker.min.js'             : [ '<%= dirs.js %>/news-ticker/jquery.newsTicker.js' ],
					'<%= dirs.js %>/magnific-popup/jquery.magnific-popup.min.js'      : [ '<%= dirs.js %>/magnific-popup/jquery.magnific-popup.js' ],
					'<%= dirs.js %>/theia-sticky-sidebar/theia-sticky-sidebar.min.js' : [ '<%= dirs.js %>/theia-sticky-sidebar/theia-sticky-sidebar.js' ],
					'<%= dirs.js %>/theia-sticky-sidebar/ResizeSensor.min.js'         : [ '<%= dirs.js %>/theia-sticky-sidebar/ResizeSensor.js' ],
					'<%= dirs.js %>/headroom/Headroom.min.js'                         : [ '<%= dirs.js %>/headroom/Headroom.js' ],
					'<%= dirs.js %>/headroom/jQuery.headroom.min.js'                  : [ '<%= dirs.js %>/headroom/jQuery.headroom.js' ],
					'<%= dirs.js %>/prognroll/prognroll.min.js'                       : [ '<%= dirs.js %>/prognroll/prognroll.js' ]
				}
			}
		},

		// Watch changes for assets.
		watch : {
			js : {
				files : [
					'<%= dirs.js %>/*.js',
					'!<%= dirs.js %>/*.min.js',
					'!<%= dirs.js %>/html5shiv.js',
					'!<%= dirs.js %>/jquery.bxslider.js'
				],
				tasks : [ 'jshint', 'uglify' ]
			}
		},

		// Generate POT files.
		makepot : {
			dist : {
				options : {
					type        : 'wp-theme',
					domainPath  : 'languages',
					potFilename : 'colormag.pot',
					potHeaders  : {
						'report-msgid-bugs-to' : 'themegrill@gmail.com',
						'language-team'        : 'LANGUAGE <EMAIL@ADDRESS>'
					}
				}
			}
		},

		// Add Textdomain.
		addtextdomain : {
			options : {
				textdomain    : 'colormag',
				updateDomains : [ 'demo-importer' ]
			},
			target  : {
				files : {
					src : [
						'**/*.php',
						'!am/**',
						'!node_modules/**',
						'!inc/demo-importer/includes/wordpress-importer/**'
					]
				}
			}
		},

		// Check textdomain errors.
		checktextdomain : {
			options : {
				text_domain : 'colormag',
				keywords    : [
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
			files   : {
				src    : [
					'**/*.php',
					'!node_modules/**'
				],
				expand : true
			}
		},

		// Download language files.
		glotpress_download : {
			options : {
				domainPath : 'languages',
				url        : 'http://translate.themegrill.com/glotpress'
			},
			theme   : {
				options : {
					textdomain  : 'colormag',
					slug        : 'themes/colormag',
					file_format : '%domainPath%/%wp_locale%.%format%'
				}
			}
		},

		// Compress files and folders.
		compress : {
			options : {
				archive : 'dist/colormag.zip'
			},
			files   : {
				src    : [
					'**',
					'!.*',
					'!*.md',
					'!*.zip',
					'!.*/**',
					'!dist/**',
					'!bower.json',
					'!gulpfile.js',
					'!Gruntfile.js',
					'!package.json',
					'!node_modules/**',
					'!package-lock.json'
				],
				dest   : 'colormag',
				expand : true
			}
		},

		// Copy
		copy  : {
			facss         : {
				files : [
					{
						cwd    : 'bower_components/font-awesome/css',  // set working folder / root to copy
						src    : '**/*.css',           // copy all files and subfolders
						dest   : 'fontawesome/css/',    // destination folder
						expand : true           // required when using cwd
					}
				]
			},
			fafonts       : {
				files : [
					{
						cwd    : 'bower_components/font-awesome/fonts',  // set working folder / root to copy
						src    : '**/*',           // copy all files and subfolders
						dest   : 'fontawesome/fonts/',    // destination folder
						expand : true           // required when using cwd
					}
				]
			},
			magnificpopup : {
				files : [
					{
						cwd    : 'bower_components/magnific-popup/dist',  // set working folder / root to copy
						src    : '**/*',           // copy all files and subfolders
						dest   : 'js/magnific-popup/',    // destination folder
						expand : true           // required when using cwd
					}
				]
			},
			fitvids       : {
				files : [
					{
						cwd    : 'bower_components/fitvids',  // set working folder / root to copy
						src    : '**/*.js',           // copy all files and subfolders
						dest   : 'js/fitvids/',    // destination folder
						expand : true           // required when using cwd
					}
				]
			},
			bxsliderjs    : {
				files : [
					{
						cwd    : 'bower_components/bxslider-4/dist',  // set working folder / root to copy
						src    : [ '**/*.js', '!vendor/*.js' ],           // copy all files and subfolders
						dest   : 'js/',    // destination folder
						expand : true           // required when using cwd
					}
				]
			},
			bxslidercss   : {
				files : [
					{
						cwd    : 'bower_components/bxslider-4/dist',  // set working folder / root to copy
						src    : '**/*.css',           // copy all files and subfolders
						dest   : 'css/',    // destination folder
						expand : true           // required when using cwd
					}
				]
			},
			easytabs      : {
				files : [
					{
						cwd    : 'bower_components/easytabs/lib',  // set working folder / root to copy
						src    : '**/*.js',           // copy all files and subfolders
						dest   : 'js/easytabs/',    // destination folder
						expand : true           // required when using cwd
					}
				]
			},
			theia         : {
				files : [
					{
						cwd    : 'bower_components/theia-sticky-sidebar/dist',  // set working folder / root to copy
						src    : '**/*.js',           // copy all files and subfolders
						dest   : 'js/theia-sticky-sidebar/',    // destination folder
						expand : true           // required when using cwd
					}
				]
			}
		},
		bower : {
			update : {
				//just run 'grunt bower:install' and you'll see files from your Bower packages in lib directory
			}
		}
	} );

	// Load NPM tasks to be used here
	grunt.loadNpmTasks( 'grunt-wp-i18n' );
	grunt.loadNpmTasks( 'grunt-glotpress' );
	grunt.loadNpmTasks( 'grunt-checktextdomain' );
	grunt.loadNpmTasks( 'grunt-contrib-jshint' );
	grunt.loadNpmTasks( 'grunt-contrib-uglify' );
	grunt.loadNpmTasks( 'grunt-contrib-watch' );
	grunt.loadNpmTasks( 'grunt-contrib-compress' );
	grunt.loadNpmTasks( 'grunt-contrib-copy' );
	grunt.loadNpmTasks( 'grunt-bower-task' );

	// Register tasks
	grunt.registerTask( 'default', [
		'jshint',
		'uglify'
	] );

	grunt.registerTask( 'js', [
		'jshint',
		'uglify:frontend'
	] );

	grunt.registerTask( 'update', [
		'bower',
		'copy'
	] );

	grunt.registerTask( 'dev', [
		'default',
		'lang'
	] );

	grunt.registerTask( 'lang', [
		'makepot',
		'glotpress_download'
	] );

	grunt.registerTask( 'zip', [
		'dev',
		'compress'
	] );
};
