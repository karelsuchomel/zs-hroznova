module.exports = function(grunt) {

  grunt.initConfig({
    watch: {
      watchSASS: {
        files: ['sass/**/*.sass', '!sass/tpl-specific/**/*.sass'],
        tasks: ['sass:main'],
      },
      watchSpecificSASS: {
        files: ['sass/tpl-specific/**/*.sass'],
        tasks: ['sass:specific'],
      },
      watchMainJS: {
        files: ['js/*.js', '!js/tpl-specific/**/*.js'],
        tasks: ['concat:concat_JS'],
      },
      watchOtherJS: {
        files: ['js/tpl-specific/**/*.js'],
        tasks: ['concat:concat_COPY'],
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
  // concat
  grunt.loadNpmTasks('grunt-contrib-concat');
  // enable CSS prefixing
  grunt.loadNpmTasks('grunt-postcss');
  // ftp deploy
  grunt.loadNpmTasks('grunt-ftp-deploy');
  // set default
  grunt.registerTask('default', ['sass', 'concat', 'watch', 'postcss']);
  grunt.registerTask('prefix', ['postcss']);
  grunt.registerTask('ftp', ['ftp-deploy']);

};
