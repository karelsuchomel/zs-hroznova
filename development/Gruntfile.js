module.exports = function(grunt) {

  grunt.initConfig({
    watch: {
      watchSASS: {
        files: ['sass/**/*.sass', '!_sass/tpl-specific/**/*.sass'],
        tasks: ['sass:main'],
      },
      watchSpecificSASS: {
        files: ['sass/tpl-specific/**/*.sass'],
        tasks: ['sass:specific'],
      },
      watchMainJS: {
        files: ['js-dev/main/*.js'],
        tasks: ['concat:concat_JS'],
      },
      watchOtherJS: {
        files: ['js-dev/*.js'],
        tasks: ['concat:concat_COPY'],
      },
      watchCSS: {
        files: ['../style.css'],
        tasks: ['postcss', 'concat:concat_CSS'],
        options: {
          debounceDelay: 5000,
        },
      },
    },
    sass: {
      main: {
        options: {             // Target options
          style: 'expanded',   // options: nested, compact, compressed, expanded
          sourcemap: 'none',   // options: auto, file, inline, none
        },
        files: {               // Dictionary of files
          '../style.css': 'sass/import.sass',  // 'destination': 'source'
        },
      },
      specific: {
        options: {               // Target options
          style: 'expanded',     // options: nested, compact, compressed, expanded
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
          '../assets/js/main.js': ['js-dev/main/*.js'],
        },
      },
      concat_COPY: {
        files: [{
          expand: true,
          cwd: 'js-dev/', // Parent directory
          src: '*.js',
          ext: '.js',
          dest: '../assets/js/',
        }],
      },
      concat_CSS: {
        options: {
          separator: '\n\n',
        },
        files: {
          '../style.css': ['sass/style-header.css', '../style.css'],
        },
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
        src: '../style.css'
      }
    },
    'ftp-deploy' : {
      build: {
        auth: {
          host: 'zshroznova.cz',
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
  // reload server
  grunt.loadNpmTasks('grunt-contrib-connect');
  // enable CSS prefixing
  grunt.loadNpmTasks('grunt-postcss');
  // ftp deploy
  grunt.loadNpmTasks('grunt-ftp-deploy');
  // set default
  grunt.registerTask('default', ['sass', 'concat', 'watch', 'postcss']);
  grunt.registerTask('prefix', ['postcss']);
  grunt.registerTask('ftp', ['ftp-deploy']);

};
