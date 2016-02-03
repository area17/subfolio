module.exports = {
  options: {
    plugins: [
      { removeViewBox: false },
      { removeUselessStrokeAndFill: false }
    ]
  },
  all:  {
    files: [{
      expand: true,
      cwd: "grunt/img/svg_source",
      src: "*.svg",
      dest: "images/fallback",
      ext: ".svg"
    }]
  }
};
