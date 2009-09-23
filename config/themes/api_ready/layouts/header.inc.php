<?php if (!API_MobileViewPort() && API_Option('header')) { ?>
	<div id="header">  <!-- Can we move the hiding stuff in the JS onLoad? -->
		<h1 id="logo"><a href='/' ><?php echo API_SiteName(); ?></a></h1>	
	</div>
<?php } ?>

<div id="breadcrumbtools">

	<?php if (API_Option('breadcrumb')) { ?>
	  <div id="breadcrumb">
			<?php if (API_UserLoggedIn()) { ?>
				<span><?php echo API_CurrentUserName(); echo API_Language('filebrowser.browsing'); ?></span>
	    <?php } ?>
			<span><?php echo API_Language('filebrowser.indexof'); ?></span>
			<span><?php echo API_Breadcrumb('/'); ?></span> <!-- Here the parameter will be used as delimiter, we can think of more options... -->
	  </div>
  <?php } ?>

  <?php if (!API_MobileViewPort()) { ?>
	  <ul id="tools">

			<?php if (API_UserLoggedIn()) { ?>
				<li><?php link_to(API_Language('filebrowser.logout'),'/logout') ?></li>
			<?php } ?>
			<!-- Or should we just do API_LogoutButton('li'); a function that includes the test + the rendering using li -->
						
			<?php if (API_Option('send_page')) { ?>
				<li><?php mail_to(API_Language('filebrowser.sendpage'), '', API_CurrentLocation()) ?></li>
			<?php } ?>

			<?php API_TinyURLButton('li') { ?>
				
			<?php API_CollapseHeaderButton('li') { ?>

	  </ul>
  <?php } ?>
</div>
 
<?php if (API_Option('display_navigation')) { ?>
  <?php require("prev_next.inc.php") ?>
<?php } ?>
