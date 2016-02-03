module.exports = function(grunt) {
  // measures the time each task takes
  require("time-grunt")(grunt);

  // individual configs are in grunt/*.js files
  require("load-grunt-config")(grunt, {
    data: {
      pkg: grunt.file.readJSON('package.json')
    }
  });
};

