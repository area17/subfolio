<div id="footer">

	<?php echo SubfolioTheme::subfolio_link(); ?>

	<?php $copyright = SubfolioTheme::get_site_copyright(); 
	if ($copyright <> '') { ?>
	<span class='copyright'>Content &copy; 2009 YourCompanyName &ndash; All rights reserved</span>
	<?php } ?>

	<?php if (!SubfolioTheme::get_mobile_viewport() && SubfolioTheme::get_option('display_updated_since')) { ?>
		<span><?php echo SubfolioLanguage::get_text('updated_since'); ?></span>
		<?php echo SubfolioFiles::updated_since_link_or_span('lastweek'); ?>
		<span class="updated_since_sep">&#8226;</span>
		<?php echo SubfolioFiles::updated_since_link_or_span('lastmonth'); ?>
		<span class="updated_since_sep">&#8226;</span>
		<?php echo SubfolioFiles::updated_since_link_or_span('lastvisit'); ?>
	<?php } ?>
	
</div>


