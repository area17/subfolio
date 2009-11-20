	<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<?php if (SubfolioTheme::get_mobile_viewport()) { ?>
		<meta name="viewport" content="width=480" />
	<?php }	?>

	<?php $meta_description = SubfolioTheme::get_site_meta_description();
	if ($meta_description <> '') { ?>
		<meta name="description" content="<?php echo $meta_description ?>" />
	<?php } ?>

	<title><?php echo SubfolioTheme::get_page_title(); ?> — <?php echo SubfolioTheme::get_site_title(); ?></title>

	<?php $favicon = SubfolioTheme::get_site_favicon_url();
	if ($favicon <> '') { ?>
	<link rel="icon" href="<?php echo $favicon ?>" type="image/vnd.microsoft.icon"  />
	<link rel="shortcut icon" href="<?php echo $favicon ?>" type="image/vnd.microsoft.icon"  />
	<?php } ?>	
	
	<link href="<?php echo SubfolioTheme::get_view_url(); ?>/css/main.css" type="text/css" rel="stylesheet" >
	<!--<link href="<?php echo SubfolioTheme::get_view_url(); "/css/".SubfolioTheme::get_listing_mode(); ?>.css" type="text/css" rel="stylesheet" >-->
	<!--[if IE 6]><link href="<?php echo SubfolioTheme::get_view_url(); ?>/css/ie6.css" type="text/css" rel="stylesheet" ><![endif]-->
	
	<?php if (SubfolioTheme::get_mobile_viewport()) { ?>
		<link href="<?php echo SubfolioTheme::get_view_url(); ?>/css/iphone.css" type="text/css" rel="stylesheet" >
	<?php }	?>

	<!-- All right. Let's overwrite with some inline styles -->
	<?php
		// Values from the settings
		$background_color = 'white';
		$background_hover_color = '#f5f5f5';
		$border_color = 'transparent';  // If you remove the border, remove the margin-top of #content
		$line_color = '#ddd';
		$text_strong_color = '#1a1a1a';
		$text_color = '#333';
		$text_light_color = '#666';
		$text_dimmed_color = '#999';
		$link_color = '#1a1a1a';
		$flash_color = 'red';
	?>
	<style type="text/css" media="screen">
	
		/* BACKGROUND */
		body, #gallery ul li a div.gallery_thumbnail, #lock form input.field
		{ background-color:<?php echo $background_color ?>; }
		
		#lock .login_header b, #gallery ul li a:hover, #gallery ul li a:hover p, #gallery ul li.hover, .subButton input
		{ color: <?php echo $background_color ?>; }
		
		/* BACKGROUND_HOVER */
		.standard_paragraph code, #breadcrumbtools a:hover, #footer a:hover, #navigation a:hover, #navigation a.hover,
		#gallery ul li a, #features ul li a:hover, .list li a:hover, .grid li a:hover
		{ background-color:<?php echo $background_hover_color ?>; }
		
		/* LINKS (must stay before the text colors) */ 
		a, a:link, a:hover, a:active, a:visited, .filename, #navigation a.hover
		{ color : <?php echo $link_color ?>; }
		#gallery ul li a:hover, #gallery ul li a:hover p, #gallery ul li.hover, .subButton input:hover
		{ background: <?php echo $link_color ?>; }
		
		/* TEXT */
		body, #lock .login_header, #footer a, #features ul li a .info p, #features ul li a .info p, .standard_paragraph a,
		#breadcrumb
		{ color : <?php echo $text_color ?>; }
		
		/* TEXT_STRONG */
		.standard_paragraph h1, .standard_paragraph h3, .standard_paragraph h4, .standard_paragraph h5,
		.standard_paragraph strong, .standard_paragraph em, .standard_paragraph b, b, strong
		{ color: <?php echo $text_strong_color ?>; }

		/* TEXT_LIGHT */
		.standard_paragraph h2, .standard_paragraph p small, .standard_paragraph p small a, #footer, .listing-header, .list li a
		{ color: <?php echo $text_light_color ?>; }
		#notice, .subButton input
		{ background-color: <?php echo $text_light_color ?>; }
		
		/* TEXT_DIMMED */
		#navigation .prev_next .faded, .grid li span.comment
		{ color: <?php echo $text_dimmed_color ?>; }
		
		/* FLASH */
		.error { color: <?php echo $flash_color ?>; }
		#notice.error, #lock .login_feedback { background-color: <?php echo $flash_color ?>; }
		
		/* BORDERS < these are the navigation borders */
		#breadcrumbtools, #navigation, #tools li a, #navigation span.prev_next .first, #navigation span.prev_next *:first-child,
		#footer, #footer a#footer-home, #footer span.copyright, .subButton
		{ border-color: <?php echo $border_color ?>; }
		
		/* LINES < these are the mandatory lines */
		.standard_paragraph code, .standard_paragraph blockquote, .standard_paragraph table td, .standard_paragraph table tr:last-child td,
		#download_box dl, #download_box dd , #download_box #instructions, #info-box, #lock form, #lock form input.field
		{ border-color: <?php echo $line_color ?>; }
		
	</style>
	
	<script language="javascript" type="text/javascript" src="<?php echo SubfolioTheme::get_view_url(); ?>/js/common.js"></script>
	<?php if (SubfolioTheme::get_mobile_viewport()) { ?>
		<script language="javascript" type="text/javascript" src="<?php echo SubfolioTheme::get_view_url(); ?>/js/main-iphone.js"></script>
	<?php }	else { ?>
		<script language="javascript" type="text/javascript" src="<?php echo SubfolioTheme::get_view_url(); ?>/js/jquery-1.3.2.min.js"></script>
		<script language="javascript" type="text/javascript" src="<?php echo SubfolioTheme::get_view_url(); ?>/js/jquery.scrollTo-min.js"></script>
		<script language="javascript" type="text/javascript" src="<?php echo SubfolioTheme::get_view_url(); ?>/js/main.js"></script>
	<?php }	?>

</head>
<body>
	<div id="container">
		<?php if (SubfolioTheme::get_notice('flash')) { ?>
			<div id="notice">
				<a href="javascript:hideFlash('notice');" id="close">Close</a>
				<p><b><?php echo SubfolioTheme::get_notice('flash'); ?></b></p>
			</div>
		<?php } ?>
		<?php if (SubfolioTheme::get_notice('error')) { ?>
			<div id="notice" class="error">
				<a href="javascript:hideFlash('notice');" id="close">Close</a>
				<p><b><?php echo SubfolioTheme::get_notice('error'); ?></b></p>
			</div>
		<?php } ?>
		<div id="container-inner">
			<?php include("header.inc.php") ?>
			<div id="content">
				<?php if (isset($content)) echo $content; ?>
			</div>
		</div>
		<?php include("footer.inc.php") ?>
	</div>

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