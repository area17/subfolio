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

  <!-- All right. Let's overwrite with some inline styles -->
  <?php
    // Main Colors -----------------------------------------------------------------------------------------------------
    $back_color                   = SubfolioTheme::get_color('back'                   , 'white');
    $main_link_color              = SubfolioTheme::get_color('main_link'              , '#1a1a1a');
    $main_link_hover_color        = SubfolioTheme::get_color('main_link_hover'        , '#999');
    $main_link_back_color         = SubfolioTheme::get_color('main_link_back_color'   , '#ffffff');
    $main_link_back_hover_color   = SubfolioTheme::get_color('main_link_back_hover'   , '#ffffff');
    $flash_color                  = SubfolioTheme::get_color('flash'                  , 'red');
    $text_strong_color            = SubfolioTheme::get_color('text_strong'            , '#1a1a1a');
    $text_color                   = SubfolioTheme::get_color('text'                   , '#333');
    $text_light_color             = SubfolioTheme::get_color('text_light'             , '#808080');
    $text_dimmed_color            = SubfolioTheme::get_color('text_dimmed'            , '#999');
    $line_color                   = SubfolioTheme::get_color('line'                   , '#ddd');

    // Optional --------------------------------------------------------------------------------------------------------
    $border_color           			= SubfolioTheme::get_color('border'                 , $line_color);
    $gallery_link_color						= SubfolioTheme::get_color('gallery_link'           , $main_link_color);
    $gallery_link_hover_color			= SubfolioTheme::get_color('gallery_link_hover'     , $main_link_hover_color);
    $gallery_back_color						= SubfolioTheme::get_color('gallery_back'           , $main_link_back_color);
    $gallery_back_hover_color			= SubfolioTheme::get_color('gallery_back_hover'     , $main_link_back_hover_color);
    $feature_link_color						= SubfolioTheme::get_color('feature_link'           , $main_link_color);
    $feature_link_hover_color			= SubfolioTheme::get_color('feature_link_hover'     , $back_color);
    $feature_text_hover_color			= SubfolioTheme::get_color('feature_text_hover'     , $text_color);
    $feature_back_color						= SubfolioTheme::get_color('feature_back'           , $main_link_back_hover_color);
    $feature_back_hover_color			= SubfolioTheme::get_color('feature_back_hover'     , $main_link_hover_color);
    $sub_link_color        				= SubfolioTheme::get_color('sub_link'               , $text_color);
    $sub_link_hover_color  				= SubfolioTheme::get_color('sub_link_hover'         , $main_link_hover_color);
    $sub_link_back_hover_color 		= SubfolioTheme::get_color('sub_link_back_hover'    , $main_link_back_hover_color);
    $back_shift_color        			= SubfolioTheme::get_color('back_shift'             , $main_link_back_hover_color);

  ?>
  <style type="text/css" media="screen">

    /* BACKGROUND */
    body, #gallery ul li a div.gallery_thumbnail
    { background-color:<?php echo $back_color ?>; }

    /* BACKGROUND_SHIFT */
    .standard_paragraph code { background-color:<?php echo $back_shift_color ?>; }

    /* LINKS (must stay before the text colors) */
    .list__cell--filename { color : <?php echo $main_link_color ?>; }
    .list a:hover, .grid li a:hover
    { background-color:<?php echo $main_link_back_hover_color ?>; }

    /* SUB LINKS (must stay before the text colors) */
    a, a:link, a:visited
    { color : <?php echo $sub_link_color ?>; }

    a:hover { color : <?php echo $sub_link_hover_color ?>; }
    #breadcrumb a:hover, #tools a:hover, #navigation a:hover, #footer a:hover, #navigation a.hover
    { color : <?php echo $sub_link_hover_color ?>; }

    /* GALLERY */
    #gallery ul li a { color : <?php echo $gallery_link_color ?>; background-color:<?php echo $gallery_back_color ?>; }
    #gallery ul li a:hover p { color : <?php echo $gallery_link_hover_color ?>; }
    #gallery ul li a:hover { background-color:<?php echo $gallery_back_hover_color ?>; }

    /* FEATURES */
    #features ul li a { color : <?php echo $feature_link_color ?>; background-color:<?php echo $feature_back_color ?>; }
    #features ul li a:hover h2 { color : <?php echo $feature_link_hover_color ?>; }
    #features ul li a:hover { background-color:<?php echo $feature_back_hover_color ?>; border-color:<?php echo $feature_back_hover_color ?>; }
    #features ul li a:hover .info p { color : <?php echo $feature_text_hover_color ?>; }

    /* LINKS 	HOVER */
    a:hover .filename { color : <?php echo $main_link_hover_color ?> !important; }

    /* TEXT */
    .standard_paragraph h1, .standard_paragraph h3, #features ul li a .info p, .standard_paragraph, .standard_paragraph p, #lock form input.field
    { color : <?php echo $text_color ?>; }

    /* TEXT_STRONG */
    .standard_paragraph h4, .standard_paragraph h5,
    .standard_paragraph strong, .standard_paragraph em, .standard_paragraph b, b, strong
    { color: <?php echo $text_strong_color ?>; }

    /* TEXT_LIGHT */
    body, #breadcrumb, .standard_paragraph h2, .standard_paragraph p small, .standard_paragraph p small a, #footer, .listing-header, .list__cell { color: <?php echo $text_light_color ?>; }
    a .list__cell--filename { color: <?php echo $text_strong_color ?>; }
    a.list__row--empty span, a.list__row--empty .list__cell--filename { color: <?php echo $text_dimmed_color ?>; }

    #notice
    { background-color: <?php echo $text_light_color ?>; }

    /* TEXT_DIMMED */
    #navigation .prev_next .faded, .grid li span.comment
    { color: <?php echo $text_dimmed_color ?>; }

    /* FLASH */
    .error { color: <?php echo $flash_color ?>; }
    #notice.error, #lock .login_feedback { background-color: <?php echo $flash_color ?>; }

    /* BORDERS < these are the navigation borders */
    #breadcrumbtools, #navigation, #tools li a, #navigation span.prev_next .first, #navigation span.prev_next *:first-child,
    #footer, #footer a#footer-home, #footer span.copyright
    { border-color: <?php echo $border_color ?>; }

    /* LINES < these are the mandatory lines */
    .standard_paragraph code, .standard_paragraph blockquote, .standard_paragraph table td, .standard_paragraph table tr:last-child td,
    #download_box dl, #download_box dd , #download_box #instructions, #info-box, #lock form, #lock form input.field, .subButton
    { border-color: <?php echo $line_color ?>; }

  </style>

  <script src="<?php echo SubfolioTheme::get_view_url(); ?>/js/common.js"></script>
  <script src="<?php echo SubfolioTheme::get_view_url(); ?>/js/jquery-1.4.2.min.js"></script>
  <script src="<?php echo SubfolioTheme::get_view_url(); ?>/js/jquery.scrollTo-min.js"></script>
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