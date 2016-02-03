<!DOCTYPE HTML>
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
  <link rel="icon" href="<?php echo $favicon ?>" type="image/vnd.microsoft.icon"  />
  <link rel="shortcut icon" href="<?php echo $favicon ?>" type="image/vnd.microsoft.icon"  />
  <?php } ?>

  <link href="<?php echo SubfolioTheme::get_view_url(); ?>/css/main.css" type="text/css" rel="stylesheet" >
  <link href="<?php echo SubfolioTheme::get_view_url(); ?>/css/icons.css" type="text/css" rel="stylesheet" >
  <script src="<?php echo SubfolioTheme::get_view_url(); ?>/js/main.js"></script>
</head>
<body>
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

</body>
</html>