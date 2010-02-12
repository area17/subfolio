<!DOCTYPE HTML>
<html lang="en">
<head>
	<title><?php echo SubfolioTheme::get_site_title(); ?></title>
	<meta charset="UTF-8">
	<?php $meta_description = SubfolioTheme::get_site_meta_description();
	if ($meta_description <> '') { ?>
		<meta name="description" content="<?php echo $meta_description ?>" />
	<?php } ?>
	<meta id="viewport" name="viewport" content="width=device-width,user-scalable=1,initial-scale=1.0, minimum-scale=1.0" />
	<link rel="apple-touch-icon" href="<?php echo SubfolioTheme::get_view_url(); ?>/images/apple-touch-icon.png"/>
	<link href="<?php echo SubfolioTheme::get_view_url(); ?>/css/common.css" type="text/css" rel="stylesheet" >
	<link href="<?php echo SubfolioTheme::get_view_url(); ?>/css/application.uri.css" type="text/css" rel="stylesheet" >
	<link href="<?php echo SubfolioTheme::get_view_url(); ?>/css/icons.uri.css" type="text/css" rel="stylesheet" >
</head>
<body>
	<div id="container">	
		<?php include("header.inc.php") ?>
		<div id="content">
			<?php if (isset($content)) echo $content; ?>
		</div>
	</div>
	<script language="javascript" type="text/javascript" src="<?php echo SubfolioTheme::get_view_url(); ?>/js/jquery-1.3.2.min.js"></script>
	<script language="javascript" type="text/javascript" src="<?php echo SubfolioTheme::get_view_url(); ?>/js/application.js"></script>
</body>
</html>