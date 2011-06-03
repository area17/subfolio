<?php if (!SubfolioTheme::get_mobile_viewport() && SubfolioTheme::get_option('display_header', true)) { ?>
	<div id="header" class="<?php if (isset($_COOKIE['header'])) echo htmlentities($_COOKIE['header']); ?>">
		<h1 id="logo"><a href='<?php print Kohana::config('filebrowser.site_root'); ?>' ><?php echo SubfolioTheme::get_site_name(); ?></a></h1>	
	</div>
<?php } ?>

<div id="breadcrumbtools">

	<?php if (SubfolioTheme::get_option('display_breadcrumb', true)) { ?>
	  <div id="breadcrumb">
			<?php if (SubfolioUser::is_logged_in()) { ?>
				<span><?php echo SubfolioUser::current_user_fullname(); echo " "; echo SubfolioLanguage::get_text('browsing'); ?></span>
	    <?php } ?>
			<?php if (SubfolioLanguage::get_text('indexof')<>'') { ?>
				<span><?php echo SubfolioLanguage::get_text('indexof'); ?></span>&nbsp;&nbsp;
			<?php } ?>
			<a href="<?php print Kohana::config('filebrowser.site_root'); ?>"><?php echo Subfolio::get_setting('site_domain'); ?></a>
			<?php foreach (SubfolioTheme::get_breadcrumb() as $crumb) { ?>
        <span class='slash'>&nbsp;/&nbsp;</span>
        <?php if ($crumb['url'] <> '') { ?>
          <a href="<?php echo $crumb['url'] ?>"><?php echo $crumb['name'] ?></a>
        <?php } else { ?>
          <span><?php echo $crumb['name'] ?></span>
        <?php }  ?>
		  <?php } ?>
	  </div>
  <?php } ?>

  <?php if (!SubfolioTheme::get_mobile_viewport()) { ?>
	  <ul id="tools">
			<?php if (SubfolioUser::is_logged_in()) { ?>
				<li><?php echo Subfolio::link_to(SubfolioLanguage::get_text('logout'),'/logout') ?></li>
			<?php } ?>

			<?php if (SubfolioTheme::get_option('display_send_page')) { 
        $subject = "Link from " . $_SERVER["SERVER_NAME"];
        $body = Subfolio::current_url();
			  ?>
				<li><?php echo Subfolio::mail_to(SubfolioLanguage::get_text('sendpage'), '', $subject, $body) ?></li>
			<?php } ?>

			<?php if (SubfolioTheme::get_option('display_tiny_url')) {
  			echo SubfolioTheme::get_tiny_url(SubfolioLanguage::get_text('generatetinyurl'), 'li');
			} ?>

			<?php if (SubfolioTheme::get_option('display_collapse_header') && SubfolioTheme::get_option('display_header', true)) {
  			echo SubfolioTheme::get_collapse_header_button('li');
			} ?>
	  </ul>
  <?php } ?>
</div>
 
<?php if (SubfolioTheme::get_option('display_navigation')) { ?>
  <?php require("prev_next.inc.php") ?>
<?php } ?>

<script>
$(document).ready(function(){
  expand_header_label = "<?php echo SubfolioLanguage::get_text('expandheader'); ?>";
  collapse_header_label = "<?php echo SubfolioLanguage::get_text('collapseheader'); ?>";
});
</script>
