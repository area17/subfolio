module.exports = {
  options: {
    processors: [
      require("autoprefixer")({browsers: "last 5 versions"}), // add vendor prefixes
    ]
  },
  all: {
    src: "css/*.css"
  }
};
