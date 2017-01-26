module.exports = function(grunt) {

  grunt.initConfig({
    watch: {
      watchSASS: {
        files: ['sass/**/*.sass'],
        tasks: ['sass'],
      },
      watchJS: {
        files: ['js-dev/**/*.js'],
        tasks: ['concat:concat_JS'],
      },
      watchCSS: {
        files: ['style.css'],
        tasks: ['concat:concat_CSS', 'postcss'],
        options: {
          debounceDelay: 5000,
        },
      },
    },
    sass: {
      dist: {                  // Target
        options: {             // Target options
          style: 'expanded',   // options: nested, compact, compressed, expanded
          sourcemap: 'none',   // options: auto, file, inline, none
        },
        files: {               // Dictionary of files
          'style.css': 'sass/import.sass',  // 'destination': 'source'
        }
      }
    },
    concat: {
      concat_JS: {
        files: {
          'js/main.js': ['js-dev/**/*.js'],
        },
        nonull: true,
      },
      concat_CSS: {
        options: {
          separator: '\n\n',
        },
        dist: {
          src: ['sass/style-header.css', 'style.css'],
          dest: 'style.css',
          nonull: true,
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
        src: 'style.css'
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
  // set default
  grunt.registerTask('default', ['sass', 'concat', 'watch', 'postcss']);
  grunt.registerTask('prefix', ['postcss']);

};
