<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>

    <title><?php print $site_title;?> | <?php print $page_title;?></title>

	<link href="<?php echo view::get_view_url() ?>/css/main.css" type="text/css" rel="stylesheet" >
	<link media="only screen and (max-device-width: 480px)" href="<?php echo view::get_view_url() ?>/css/iphone.css" type="text/css" rel="stylesheet" >
		 
	<link rel="icon" href="<?php echo view::get_view_url() ?>/favicon.ico" type="image/x-con" />
	<link rel="shortcut icon" href="<?php echo view::get_view_url() ?>/favicon.ico" type="image/x-con" />
	
	<script language="javascript" type="text/javascript" src="<?php echo view::get_view_url() ?>/js/browserdetect_lite.js"></script>
	<script language="javascript" type="text/javascript" src="<?php echo view::get_view_url() ?>/js/global.js"></script>
	<script language="javascript" type="text/javascript" src="<?php echo view::get_view_url() ?>/js/rollover.js"></script>

</head>
  <?php include("header.inc.php") ?>

  <?php echo Session::instance()->get('flash'); ?>

  <div id="content">
  <?php if (isset($content)) echo $content; ?>		
  </div>

  <?php include("footer.inc.php") ?>
</body>
</html>


