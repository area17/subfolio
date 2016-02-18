// Full list of files that must be included in JS
var includes_js = [
  "grunt/js/jquery-2.2.0.min.js",
  "grunt/js/jquery.scrollTo-min.js",
  "grunt/js/masonry.pkgd.min.js",
  "grunt/js/imagesloaded.pkgd.js",
  "grunt/js/jquery.serializejson.min.js",
  "grunt/js/fecha.min.js",
  "grunt/js/main.js",
  "grunt/js/behaviors/*.js",
  "grunt/js/helpers/*.js"
];

module.exports = {
  dev: {
    options: {
      mangle: false,
      beautify: true,
      compress: false,
      preserveComments: true
    },
    files: {
      "js/main.js": includes_js
    }
  },
  staging: {
    options: {
      mangle: false,
      beautify: false,
      compress: true,
      preserveComments: false
    },
    files: {
      "dist/js/main.js": includes_js
    }
  }
};
