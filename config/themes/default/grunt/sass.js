const sass = require('node-sass');

module.exports = {
  dev: {
    options: {
      implementation: sass,
      sourceMap: false,
      outputStyle: "nested"
    },
    files: {
      "css/main.css": "grunt/scss/main.scss",
      "css/icons.css": "grunt/scss/icons.scss"
    }
  },
  staging: {
    options: {
      implementation: sass,
      sourceMap: false,
      outputStyle: "compressed"
    },
    files: {
      "dist/css/main.css": "grunt/scss/main.scss",
      "dist/css/icons.css": "grunt/scss/icons.scss"
    }
  }
};
