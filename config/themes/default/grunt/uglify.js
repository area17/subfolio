module.exports = {
  dev: {
    options: {
      mangle: false,
      beautify: true,
      compress: false,
      preserveComments: true
    },
    files: {
      "js/main.js": [
        "grunt/js/common.js",
        "grunt/js/*.js",
        "grunt/js/main.js"
      ]
    }
  }
};
