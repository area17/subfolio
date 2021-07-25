module.exports = {
  options: {
    processors: [
      require("autoprefixer")(), // use package.json's `browserslist` to change prefixes
    ]
  },
  all: {
    src: "css/*.css"
  }
};
