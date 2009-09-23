<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<?php if (API_MobileViewPort()) { ?>
		<meta name="viewport" content="width=480" />
	<?php }	?>
	<title><?php echo API_PageTitle(); ?> — <?php echo API_SiteTitle();?></title>
	<link rel="icon" href="<?php echo API_ViewUrl(); ?>/favicon.ico" type="image/x-con" />
	<link rel="shortcut icon" href="<?php echo API_ViewUrl(); ?>/favicon.ico" type="image/x-con" />
	
	<link href="<?php echo API_ViewUrl(); ?>/css/main.css" type="text/css" rel="stylesheet" >
	<!--<link href="<?php echo API_ViewUrl();."/css/".$listing_mode ?>.css" type="text/css" rel="stylesheet" >-->
	<!--[if IE 7]><link href="<?php echo API_ViewUrl(); ?>/css/ie7.css" type="text/css" rel="stylesheet" ><![endif]-->
	
	<?php if (API_MobileViewPort()) { ?>
		<link href="<?php echo API_ViewUrl(); ?>/css/iphone.css" type="text/css" rel="stylesheet" >
	<?php }	?>
</head>
<body>
	<div id="container">
		<?php if (API_GetNotice('flash')) { ?>
			<div id="notice">
				<a href="javascript:hideFlash('notice');" id="close">Close</a>
				<p><b><?php echo API_GetNotice('flash'); ?></b></p>
			</div>
		<?php } ?>
		<?php if (API_GetNotice('error')) { ?>
			<div id="notice" class="error">
				<a href="javascript:hideFlash('notice');" id="close">Close</a>
				<p><b><?php echo API_GetNotice('error'); ?></b></p>
			</div>
		<?php } ?>
		<div id="container-inner">
			<?php include("header.inc.php") ?>
			<div id="content">
				<?php echo API_Content(); ?>
			</div>
		</div>
		<?php include("footer.inc.php") ?>
	</div>
	<script language="javascript" type="text/javascript" src="<?php echo API_ViewUrl(); ?>/js/common.js"></script>
	<?php if (API_MobileViewPort()) { ?>
		<script language="javascript" type="text/javascript" src="<?php echo API_ViewUrl(); ?>/js/main-iphone.js"></script>
	<?php }	else { ?>
		<script language="javascript" type="text/javascript" src="<?php echo API_ViewUrl(); ?>/js/jquery-1.3.2.min.js"></script>
		<script language="javascript" type="text/javascript" src="<?php echo API_ViewUrl(); ?>/js/main.js"></script>
	<?php }	?>
</body>
</html>