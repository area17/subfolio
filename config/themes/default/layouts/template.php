<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<?php 
  $listing_mode = Kohana::config('filebrowser.listing_mode');
  $listing_mode = view::get_option('listing_mode', $listing_mode);
  $listing_mode = $this->filebrowser->get_folder_property('listing_mode', $listing_mode); ?>

	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<title><?php print $page_title;?> — <?php print $site_title;?></title>
	<link rel="icon" href="<?php echo view::get_view_url() ?>/favicon.ico" type="image/x-con" />
	<link rel="shortcut icon" href="<?php echo view::get_view_url() ?>/favicon.ico" type="image/x-con" />
	<link rel="shortcut icon" type="image/png" href="<?php echo view::get_view_url() ?>/images/logos/favicon.png" />
	
	<link href="<?php echo view::get_view_url() ?>/css/main.css" type="text/css" rel="stylesheet" >
	<link href="<?php echo view::get_view_url()."/css/".$listing_mode ?>.css" type="text/css" rel="stylesheet" >
	<!--[if IE 7]><link href="<?php echo view::get_view_url() ?>/css/ie7.css" type="text/css" rel="stylesheet" ><![endif]-->
	
	<!--[if !IE]>-->
	<link media="only screen and (max-device-width: 480px)" href="<?php echo view::get_view_url() ?>/css/iphone.css" type="text/css" rel="stylesheet" >
	<!--<![endif]-->
</head>
<body>
	<div id="container">
		<?php if (Session::instance()->get('flash')) { ?>
			<div id="notice">
				<a href="javascript:hideFlash('notice');" id="close">Close</a>
				<p><b><?php echo Session::instance()->get('flash'); ?></b></p>
			</div>
		<?php } ?>
		<?php if (Session::instance()->get('error')) { ?>
			<div id="notice" class="error">
				<a href="javascript:hideFlash('notice');" id="close">Close</a>
				<p><b><?php echo Session::instance()->get('error'); ?></b></p>
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
	<script language="javascript" type="text/javascript" src="/config/themes/default/js/jquery-1.3.2.min.js"></script>
	<script language="javascript" type="text/javascript" src="/config/themes/default/js/main.js"></script>
</body>
</html>


