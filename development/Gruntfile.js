module.exports = function(grunt) {

	grunt.initConfig({
		watch: {
			watchSASS: {
				files: ['sass/**/*.sass', '!sass/tpl-specific/**/*.sass', '!sass/admin/**/*.sass'],
				tasks: ['sass:main'],
			},
			watchSpecificSASS: {
				files: ['sass/tpl-specific/**/*.sass'],
				tasks: ['sass:specific'],
			},
			watchAdminSASS: {
				files: ['sass/admin/**/*.sass'],
				tasks: ['sass:adminStyles'],
			},
			watchMainJS: {
				files: ['js/*.js', '!js/tpl-specific/**/*.js'],
				tasks: ['uglify:main_JS'],
			},
			watchOtherJS: {
				files: ['js/tpl-specific/**/*.js'],
				tasks: ['uglify:tpl_Specific_JS'],
			},
			watchCSS: {
				files: ['../assets/css/main.css'],
				tasks: ['postcss'],
				options: {
					debounceDelay: 5000,
				},
			},
		},
		sass: {
			main: {
				options: {             // Target options
					style: 'compressed',   // options: nested, compact, compressed, expanded
					sourcemap: 'none',   // options: auto, file, inline, none
				},
				files: {               // Dictionary of files
					'../assets/css/main.css': 'sass/import.sass',  // 'destination': 'source'
				},
			},
			specific: {
				options: {               // Target options
					style: 'compressed',     // options: nested, compact, compressed, expanded
					sourcemap: 'none',     // options: auto, file, inline, none
				},
				files: [{                 // Dictionary of files
					expand: true,
					cwd: 'sass/tpl-specific/', // Parent directory
					src: '**/*.sass',
					ext: '.css',
					dest: '../assets/css/',
				}],
			},
			adminStyles: {
				options: {
					style: 'expanded',
					sourcemap: 'none',
				},
				files: [{
					expand: true,
					cwd: 'sass/admin/', 
					src: '**/*.sass',
					ext: '.css',
					dest: '../assets/css/',
				}]
			}
		},
		concat: {
			concat_JS: {
				files: {
					'../assets/js/main.js': ['js/*.js'],
				},
			},
			concat_COPY: {
				files: [{
					expand: true,
					cwd: 'js/tpl-specific/', // Parent directory
					src: '*.js',
					ext: '.js',
					dest: '../assets/js/',
				}],
			},
		},
		postcss: {
			options: {
				map: false,
				processors: [
					require('autoprefixer')({browsers: ['last 20 versions']})
				]
			},
			dist: {
				src: '../assets/css/*.css'
			}
		},
		uglify: {
			main_JS: {
				files: {
					'../assets/js/main.js': ['js/*.js'],
				},
			},
			tpl_Specific_JS: {
				files: [{
					expand: true,
					cwd: 'js/tpl-specific/',
					src: '**/*.js',
					dest: '../assets/js'
				}]
			},
		},
		'ftp-deploy' : {
			build: {
				auth: {
					host: 'www.zshroznova.cz',
					port: 21,
					authKey: 'key1'
				},
				src: ['../'],
				dest: '/wp-content/themes/zs-hroznova/',
				exclusions: [ '../development', '../.gitignore', '../cmd2', '../.git']
			}
		}
	});

	//looks for your grunt.initConfig object
	// watch
	grunt.loadNpmTasks('grunt-contrib-watch');
	// compile Sass to CSS
	grunt.loadNpmTasks('grunt-contrib-sass');
	// enable CSS prefixing
	grunt.loadNpmTasks('grunt-postcss');
	// ftp deploy
	grunt.loadNpmTasks('grunt-ftp-deploy');
	// minify javascript
	grunt.loadNpmTasks('grunt-contrib-uglify');
	// set default
	grunt.registerTask('default', ['sass', 'watch', 'postcss', 'uglify']);
	grunt.registerTask('prefix', ['postcss']);
	grunt.registerTask('ftp', ['ftp-deploy']);

};
