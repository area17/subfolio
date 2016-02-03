module.exports = {
  all: {
    options: {
      csstemplate: "grunt/hbs/svgcss_template.hbs",
      defaultWidth: "16px",
      defaultHeight: "16px",
      previewhtml: "icons.html",
      previewtemplate: "grunt/hbs/svgcss_previewtemplate.hbs",
      banner: "/*!\n" +
              " * Generated with a Grunt task\n" +
              " * #### DON\"T EDIT THIS FILE\n" +
              " */\n",
      insertfinalnewline: true
    },
    files: {
      "grunt/img/_icons.scss" : ["images/fallback/*.svg"]
    }
  }
}
