<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<?php if (SubfolioTheme::get_mobile_viewport()) { ?>
		<meta name="viewport" content="width=480" />
	<?php }	?>
	<title><?php echo SubfolioTheme::get_page_title(); ?> — <?php echo SubfolioTheme::get_site_title(); ?></title>
	<link rel="icon" href="<?php echo SubfolioTheme::get_page_title(); ?>/favicon.ico" type="image/x-con" />
	<link rel="shortcut icon" href="<?php echo SubfolioTheme::get_view_url(); ?>/favicon.ico" type="image/x-con" />
	
	<link href="<?php echo SubfolioTheme::get_view_url(); ?>/css/main.css" type="text/css" rel="stylesheet" >
	<!--<link href="<?php echo SubfolioTheme::get_view_url(); "/css/".SubfolioTheme::get_listing_mode(); ?>.css" type="text/css" rel="stylesheet" >-->
	<!--[if IE 7]><link href="<?php echo SubfolioTheme::get_view_url(); ?>/css/ie7.css" type="text/css" rel="stylesheet" ><![endif]-->
	
	<?php if (SubfolioTheme::get_mobile_viewport()) { ?>
		<link href="<?php echo SubfolioTheme::get_view_url(); ?>/css/iphone.css" type="text/css" rel="stylesheet" >
	<?php }	?>

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
</body>
</html>