module.exports = function(grunt) {

	grunt.initConfig({

		pkg: grunt.file.readJSON('package.json'),
        coffee: {
            dev: {
                expand: true,
                flatten: true,
                cwd: '../coffee',
                src: ['*.coffee'],
                dest: '../js',
                ext: '.js'
            }

        },
		// check our JS
		jshint: {
			options: {
				"bitwise": true,
				"browser": true,
				"curly": true,
				"eqeqeq": true,
				"eqnull": true,
				"esnext": true,
				"immed": true,
				"jquery": true,
				"latedef": true,
				"newcap": true,
				"noarg": true,
				"node": true,
				"strict": false,
				"trailing": true,
				"undef": true,
				"globals": {
					"jQuery": true,
					"alert": true
				}
			},
			all: [
				'gruntfile.js',
				'../../js/script.js',
                '../js/*.js'
			]
		},

		// concat and minify our JS
        concat: {
            dev: {
                files: {
                    '../../js/scripts.js': [
                        '../js/*.js'
                    ]
                }
            }
        },
		uglify: {
			dist: {
				files: {
					'../../js/scripts.min.js': [
						'../../js/scripts.js'
					]
				}
			}
		},

		// compile your sass
		less: {
			dev: {
				options: {
					style: 'expanded'
				},
				src: ['../less/style.less'],
				dest: '../../style.css'
			},
			prod: {
				options: {
					style: 'compressed'
				},
				src: ['../less/style.less'],
				dest: '../../style.css'
			},
			editorstyles: {
				options: {
					style: 'expanded'
				},
				src: ['../less/wp-editor-style.less'],
				dest: '../../css/wp-editor-style.css'
			}
		},
        cssmin: {
            combine: {
                files: {
                    '../../style.min.css': ['../../style.css']
                }
            }
        },

		// watch for changes
		watch: {
			less: {
				files: ['../less/**/*.less'],
				tasks: [
					'less:dev',
					'less:editorstyles',
					'notify:less'
				]
			},
			js: {
				files: [
					'<%= jshint.all %>'
				],
				tasks: [
					'jshint',
					'uglify',
					'notify:js'
				]
			}
		},

		// check your php
		phpcs: {
			application: {
				dir: '../../*.php'
			},
			options: {
				bin: '/usr/bin/phpcs'
			}
		},

		// notify cross-OS
		notify: {
			less: {
				options: {
					title: 'Grunt, grunt!',
					message: 'LESS is all great'
				}
			},
			js: {
				options: {
					title: 'Grunt, grunt!',
					message: 'JS is all good'
				}
			},
			dist: {
				options: {
					title: 'Grunt, grunt!',
					message: 'Theme ready for production'
				}
			}
		},

		clean: {
			dist: {
				src: ['../../dist'],
				options: {
					force: true
				}
			}
		},

		copyto: {
			dist: {
				files: [
					{cwd: '../', src: ['**/*'], dest: '../../dist/'}
				],
				options: {
					ignore: [
						'../dist{,/**/*}',
						'../doc{,/**/*}',
						'../grunt{,/**/*}',
						'../less{,/**/*}'
					]
				}
			}
		}
	});

	// Load NPM's via matchdep
	require('matchdep').filterDev('grunt-*').forEach(grunt.loadNpmTasks);

	// Development task
	grunt.registerTask('default', [
        'coffee:dev',
		'jshint',
        'concat:dev',
		'uglify',
		'less:dev',
		'less:editorstyles',
        'cssmin'
	]);

	// Production task
	grunt.registerTask('dist', function() {
		grunt.task.run([
			'jshint',
			'uglify',
			'less:prod',
			'less:editorstyles',
			'clean:dist',
            'cssmin',
			'copyto:dist',
			'notify:dist'
		]);
	});
};