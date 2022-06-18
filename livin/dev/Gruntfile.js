module.exports = function (grunt) {
  // Load all Grunt tasks
  require("jit-grunt")(grunt);

  // Sass variable, for newer grunt-sass
  const sass = require("node-sass");

  grunt.initConfig({
    pkg: grunt.file.readJSON("package.json"),

    sass: {
      dev: {
        options: {
          implementation: sass,
          outputStyle: "expanded",
          sourceMap: true,
        },
        files: {
          "../style.css": "sass/style.scss",
          "../admin-style.css": "sass/admin-style.scss",
        },
      },
      prod: {
        options: {
          implementation: sass,
          outputStyle: "compressed",
          sourceMap: false,
        },
        files: {
          "../style.css": "sass/style.scss",
          "../admin-style.css": "sass/admin-style.scss",
        },
      },
    },

    autoprefixer: {
      options: {
        browsers: [
          "> 0.5%",
          "last 5 versions",
          "Firefox ESR",
          "iOS > 3",
          "ie >6",
        ],
      },
      compile: {
        files: {
          "../style.css": "sass/style.css",
          "../admin-style.css": "sass/admin-style.css",
        },
      },
    },

    uglify: {
      js: {
        files: {
          "../js/custom.min.js": ["js/custom.js"],
        },
      },
    },

    watch: {
      options: {
        livereload: true,
        spawn: false,
      },
      sass: {
        files: ["sass/**/*.scss", "js/*.*"],
        tasks: ["sass:dev", "autoprefixer", "uglify"],
      },
    },
  });

  // grunt.registerTask('default', ['sass', 'autoprefixer', 'uglify']);
  grunt.registerTask("default", ["watch"]);

  // Minify style.css
  grunt.registerTask("prod", ["autoprefixer", "sass:prod"]);
};
