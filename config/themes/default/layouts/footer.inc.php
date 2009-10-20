<div id="footer">

	<?php echo SubfolioTheme::subfolio_link(); ?> <!-- Users can remove that line -->

	<!-- <span class='copyright'>Content ©2009 YourCompanyName — All rights reserved</span> -->

	<?php if (SubfolioTheme::get_option('display_updated_since')) { ?>
		<span><?php echo SubfolioLanguage::get_text('updated_since'); ?></span>
		<?php echo SubfolioFiles::updated_since_link_or_span('lastweek'); ?>
		<span class="updated_since_sep">&#8226;</span>
		<?php echo SubfolioFiles::updated_since_link_or_span('lastmonth'); ?>
		<span class="updated_since_sep">&#8226;</span>
		<?php echo SubfolioFiles::updated_since_link_or_span('lastvisit'); ?>
	<?php } ?>
	
</div>


