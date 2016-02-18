<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
  <meta name="theme-color" content="#000000">

  <?php $meta_description = SubfolioTheme::get_site_meta_description();
  if ($meta_description <> '') { ?>
    <meta name="description" content="<?php echo $meta_description ?>" />
  <?php } ?>

  <title><?php if (SubfolioTheme::get_page_title() <> '') { echo SubfolioTheme::get_page_title() . " &mdash; "; } ?> <?php echo SubfolioTheme::get_site_title(); ?></title>

  <?php $favicon = SubfolioTheme::get_site_favicon_url();
  if ($favicon <> '') { ?>
  <link rel="icon" href="<?php echo $favicon ?>?v=2" type="image/vnd.microsoft.icon"  />
  <link rel="shortcut icon" href="<?php echo $favicon ?>?v=2" type="image/vnd.microsoft.icon"  />
  <?php } ?>

  <link href="<?php echo SubfolioTheme::get_view_url(); ?>/css/main.css" type="text/css" rel="stylesheet" >
  <script>
  var A17 = window.A17 || {};
  A17.svgSupport = document.implementation.hasFeature("http://www.w3.org/TR/SVG11/feature#BasicStructure", "1.1");
  A17.browserSpec = typeof document.querySelectorAll && "addEventListener" in window && A17.svgSupport ? "html5" : "html4";
  A17.touch = "ontouchstart" in window || window.DocumentTouch && document instanceof DocumentTouch;

  (function() {
      var doc = document.documentElement;
      var str = " js " + A17.browserSpec + (A17.touch ? " touch" : " no-touch") + (A17.svgSupport ? " svg" : " no-svg");
      doc.className = doc.className.replace(/\bno-js\b/, str);
  })();

  A17.loadCSS = function(href) {
      "use strict";
      var ss = window.document.createElement("link");
      var ref = window.document.getElementsByTagName("script")[0];
      var sheets = window.document.styleSheets;
      ss.rel = "stylesheet";
      ss.href = href;
      ss.media = "only x";
      ref.parentNode.insertBefore(ss, ref);
      ss.onloadcssdefined = function(cb) {
          var defined;
          for (var i = 0; i < sheets.length; i++) {
              if (sheets[i].href && sheets[i].href.indexOf(href) > -1) {
                  defined = true;
              }
          }
          if (defined) {
              cb();
          } else {
              setTimeout(function() {
                  ss.onloadcssdefined(cb);
              });
          }
      };
      ss.onloadcssdefined(function() {
          ss.media = "all";
      });
      return ss;
  };
  </script>
  <script>A17.loadCSS("<?php echo SubfolioTheme::get_view_url(); ?>/css/icons.css");</script>
</head>

<body class="<?php if (isset($page_class)) echo $page_class; ?> <?php if (isset($_COOKIE['header'])) { if ($_COOKIE['header'] == "header__hide") { echo "header__hide"; } } ?>">
  <div id="container">
    <div id="container-inner">
      <?php include("header.inc.php") ?>
      <div id="content">
        <?php if (isset($content)) echo $content; ?>
      </div>
    </div>
    <?php include("footer.inc.php") ?>
  </div>

  <?php if (SubfolioTheme::get_notice('flash')) { ?>
    <div id="notice">
      <p><?php echo SubfolioTheme::get_notice('flash'); ?></p>
    </div>
  <?php } ?>
  <?php if (SubfolioTheme::get_notice('error')) { ?>
    <div id="notice" class="error">
      <p><?php echo SubfolioTheme::get_notice('error'); ?></p>
    </div>
  <?php } ?>

  <?php $ga_code = Subfolio::get_setting('google_analytics_code');
  if ($ga_code <> '') { ?>
      <script type="text/javascript">
      var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
      document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
      </script>
      <script type="text/javascript">
      try {
      var pageTracker = _gat._getTracker("<?php echo $ga_code ?>");
      pageTracker._trackPageview();
      } catch(err) {}</script>
  <?php } ?>

  <script src="<?php echo SubfolioTheme::get_view_url(); ?>/js/main.js"></script>
</body>
</html>