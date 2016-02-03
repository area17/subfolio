module.exports = {
  sass: {
    files: ["grunt/scss/**/*.scss"],
    tasks: ["sass:dev", "notify:sass"],
    options: {livereload: true}
  },
  scripts: {
    files: ["grunt/js/*.js"],
    tasks: ["newer:uglify:dev", "notify:js"],
    options: {livereload: true}
  },
  livereload: {
    files: [
      "grunt/css/*.css",
      "grunt/js/*.js"
    ]
  }
};
