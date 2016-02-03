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
    $border_color                 = SubfolioTheme::get_color('border'                 , $line_color);
    $gallery_link_color           = SubfolioTheme::get_color('gallery_link'           , $main_link_color);
    $gallery_link_hover_color     = SubfolioTheme::get_color('gallery_link_hover'     , $main_link_hover_color);
    $gallery_back_color           = SubfolioTheme::get_color('gallery_back'           , $main_link_back_color);
    $gallery_back_hover_color     = SubfolioTheme::get_color('gallery_back_hover'     , $main_link_back_hover_color);
    $feature_link_color           = SubfolioTheme::get_color('feature_link'           , $main_link_color);
    $feature_link_hover_color     = SubfolioTheme::get_color('feature_link_hover'     , $back_color);
    $feature_text_hover_color     = SubfolioTheme::get_color('feature_text_hover'     , $text_color);
    $feature_back_color           = SubfolioTheme::get_color('feature_back'           , $main_link_back_hover_color);
    $feature_back_hover_color     = SubfolioTheme::get_color('feature_back_hover'     , $main_link_hover_color);
    $sub_link_color               = SubfolioTheme::get_color('sub_link'               , $text_color);
    $sub_link_hover_color         = SubfolioTheme::get_color('sub_link_hover'         , $main_link_hover_color);
    $sub_link_back_hover_color    = SubfolioTheme::get_color('sub_link_back_hover'    , $main_link_back_hover_color);
    $back_shift_color             = SubfolioTheme::get_color('back_shift'             , $main_link_back_hover_color);

  ?>
  <style type="text/css" media="screen">

    /* BACKGROUND */
    body, #gallery ul li a div.gallery_thumbnail {
      background-color:<?php echo $back_color ?>;
    }

    /* BACKGROUND_SHIFT */
    .standard_paragraph code {
      background-color:<?php echo $back_shift_color ?>;
    }

    /* LINKS (must stay before the text colors) */
    .list__cell--filename {
      color : <?php echo $main_link_color ?>;
    }
    .list a:hover, .grid li a:hover {
      background-color:<?php echo $main_link_back_hover_color ?>;
    }

    /* SUB LINKS (must stay before the text colors) */
    a, a:link, a:visited {
      color : <?php echo $sub_link_color ?>;
    }

    a:hover {
      color : <?php echo $sub_link_hover_color ?>;
    }
    .breadcrumb a:hover, .header__logout a:hover, .header__navigation a:hover, #footer a:hover, .header__navigation a.hover {
      color : <?php echo $sub_link_hover_color ?>;
    }

    /* GALLERY */
    #gallery ul li a {
      color : <?php echo $gallery_link_color ?>;
      background-color:<?php echo $gallery_back_color ?>;
    }
    #gallery ul li a:hover p {
      color : <?php echo $gallery_link_hover_color ?>;
    }
    #gallery ul li a:hover {
      background-color:<?php echo $gallery_back_hover_color ?>;
    }

    /* FEATURES */
    #features ul li a {
      color : <?php echo $feature_link_color ?>;
      background-color:<?php echo $feature_back_color ?>;
    }
    #features ul li a:hover h2 {
      color : <?php echo $feature_link_hover_color ?>;
    }
    #features ul li a:hover {
      background-color:<?php echo $feature_back_hover_color ?>;
      border-color:<?php echo $feature_back_hover_color ?>;
    }
    #features ul li a:hover .info p {
      color : <?php echo $feature_text_hover_color ?>;
    }

    /* LINKS  HOVER */
    a:hover .filename {
      color : <?php echo $main_link_hover_color ?> !important;
    }

    /* TEXT */
    .standard_paragraph h1,
    .standard_paragraph h3,
    #features ul li a .info p,
    .standard_paragraph,
    .standard_paragraph p,
    #lock form input.field {
      color : <?php echo $text_color ?>;
    }

    /* TEXT_STRONG */
    .standard_paragraph h4, .standard_paragraph h5,
    .standard_paragraph strong, .standard_paragraph em, .standard_paragraph b, b, strong {
      color: <?php echo $text_strong_color ?>;
    }

    /* TEXT_LIGHT */
    body, .breadcrumb,
    .standard_paragraph h2,
    .standard_paragraph p small,
    .standard_paragraph p small a,
    #footer,
    .listing-header,
    .list__cell,
    .header__logout a {
      color: <?php echo $text_light_color ?>;
    }
    a .list__cell--filename,
    .header__logout a:hover {
      color: <?php echo $text_strong_color ?>;
    }
    a.list__row--empty span,
    a.list__row--empty .list__cell--filename {
      color: <?php echo $text_dimmed_color ?>;
    }

    #notice {
      background-color: <?php echo $text_light_color ?>;
    }

    /* TEXT_DIMMED */
    .grid li span.comment {
      color: <?php echo $text_dimmed_color ?>;
    }

    /* FLASH */
    .error {
      color: <?php echo $flash_color ?>;
    }
    #notice.error,
    #lock .login_feedback {
      background-color: <?php echo $flash_color ?>;
    }

    /* BORDERS < these are the navigation borders */
    .breadcrumbtools,
    .header__navigation,
    #footer,
    #footer a#footer-home,
    #footer span.copyright {
      border-color: <?php echo $border_color ?>;
    }

    /* LINES < these are the mandatory lines */
    .standard_paragraph code,
    .standard_paragraph blockquote,
    .standard_paragraph table td,
    .standard_paragraph table tr:last-child td,
    #download_box dl,
    #download_box dd ,
    #download_box #instructions,
    #info-box, #lock form,
    #lock form input.field,
    .subButton {
      border-color: <?php echo $line_color ?>;
    }

  </style>