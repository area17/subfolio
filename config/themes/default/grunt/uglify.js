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
        "grunt/js/jquery-1.7.1.min.js",
        "grunt/js/jquery.scrollTo-min.js",
        "grunt/js/masonry.pkgd.min.js",
        "grunt/js/imagesloaded.pkgd.js",
        "grunt/js/main.js",
        "grunt/js/behaviors/*.js",
        "grunt/js/helpers/*.js"
      ]
    }
  }
};
