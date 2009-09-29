<?php if (!SubfolioTheme::get_mobile_viewport() && SubfolioTheme::get_option('display_header', true)) { ?>
	<div id="header">  <!-- Can we move the hiding stuff in the JS onLoad? -->
		<h1 id="logo"><a href='/' ><?php echo SubfolioTheme::get_site_name(); ?></a></h1>	
	</div>
<?php } ?>

<div id="breadcrumbtools">

	<?php if (SubfolioTheme::get_option('breadcrumb', true)) { ?>
	  <div id="breadcrumb">
			<?php if (SubfolioUser::is_logged_in()) { ?>
				<span><?php echo SubfolioUser::current_user_name(); echo SubfolioLanguage::get_text('filebrowser.browsing'); ?></span>
	    <?php } ?>
			<span><?php echo SubfolioLanguage::get_text('filebrowser.indexof'); ?></span>
			<span><?php echo Subfolio::get_breadcrumb('/'); ?></span> <!-- Here the parameter will be used as delimiter, we can think of more options... -->
	  </div>
  <?php } ?>

  <?php if (!API_MobileViewPort()) { ?>
	  <ul id="tools">

			<?php if (SubfolioUser::is_logged_in()) { ?>
				<li><?php link_to(API_Language('filebrowser.logout'),'/logout') ?></li>
			<?php } ?>
			<!-- Or should we just do API_LogoutButton('li'); a function that includes the test + the rendering using li -->
						
			<?php if (API_Option('send_page')) { ?>
				<li><?php mail_to(API_Language('filebrowser.sendpage'), '', API_CurrentLocation()) ?></li>
			<?php } ?>

			<?php API_TinyURLButton('li') ?>
				
			<?php API_CollapseHeaderButton('li') ?>

	  </ul>
  <?php } ?>
</div>
 
<?php if (API_Option('display_navigation')) { ?>
  <?php require("prev_next.inc.php") ?>
<?php } ?>
