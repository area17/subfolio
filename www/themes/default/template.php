<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>

    <title><?php print $site_title;?> | <?php print $page_title;?></title>

	<link href="<?php echo view::get_view_url() ?>/css/main.css" type="text/css" rel="stylesheet" >
	<link media="only screen and (max-device-width: 480px)" href="<?php echo view::get_view_url() ?>css/iphone.css" type="text/css" rel="stylesheet" >
		 
	<link rel="icon" href="<?php echo view::get_view_url() ?>/favicon.ico" type="image/x-con" />
	<link rel="shortcut icon" href="<?php echo view::get_view_url() ?>/favicon.ico" type="image/x-con" />
	
	<script language="javascript" type="text/javascript" src="<?php echo view::get_view_url() ?>/js/browserdetect_lite.js"></script>
	<script language="javascript" type="text/javascript" src="<?php echo view::get_view_url() ?>/js/global.js"></script>
	<script language="javascript" type="text/javascript" src="<?php echo view::get_view_url() ?>/js/rollover.js"></script>

</head>
  <?php include("header.inc.php") ?>

  <?php if (isset($content)) echo $content; ?>		

<div id='file_listing' class='clearfix'><div class='clearfix list'><div class='fileicon'><img src='/engine/assets/images/no_icon.gif' width='30' height='14' border='0' /></div><div class='filename'>filename</div><div class='filesize'><a href='/&sort=size'>size</a></div><div class='filedate'><a href='/&sort=date'>date</a></div><div class='filekind'><a href='/&sort=kind'>kind</a></div></div><div class='clearfix list'><div class='fileicon'><a href="/01_general_information/" target=''><img src='/engine/assets/images/i_dir.gif' alt='' width='30' height='14' border='0' /></a></div><div class='filename'><a href="/01_general_information/" target=''>01 general information</a></div><div class='filesize'></div><div class='filedate'>Sep 29, 2008</div><div class='filekind'>Folder</div><div class='filecomment'></div></div><div class='clear'><!-- --></div><div class='clearfix list'><div class='fileicon'><a href="/02_demo_browslets/" target=''><img src='/engine/assets/images/i_dir.gif' alt='' width='30' height='14' border='0' /></a></div><div class='filename'><a href="/02_demo_browslets/" target=''>02 demo browslets</a></div><div class='filesize'></div><div class='filedate'>Sep 29, 2008</div><div class='filekind'>Folder</div><div class='filecomment'></div></div><div class='clear'><!-- --></div><div class='clearfix list'><div class='fileicon'><a href="/03_demo_file_kinds/" target=''><img src='/engine/assets/images/i_dir.gif' alt='' width='30' height='14' border='0' /></a></div><div class='filename'><a href="/03_demo_file_kinds/" target=''>03 demo file kinds</a></div><div class='filesize'></div><div class='filedate'>Sep 29, 2008</div><div class='filekind'>Folder</div><div class='filecomment'></div></div><div class='clear'><!-- --></div></div><!-- RELATED LINKS --->

  <?php include("footer.inc.php") ?>
</body>
</html>


