<div id="footer">

	<?php API_SubfolioLink(); ?> <!-- Users can remove that line -->
	
	<?php if (API_Option('display_updated_since')) { ?>
		<span><?php echo API_Language('filebrowser.updated_since'); ?></span>
		<?php API_UpdatedSinceLinkOrSpan('lastweek'); ?>
		<span class="footer_sep">&#8226;</span>
		<?php API_UpdatedSinceLinkOrSpan('lastmonth'); ?>
		<span class="footer_sep">&#8226;</span>
		<?php API_UpdatedSinceLinkOrSpan('lastvisit'); ?>
	<?php } ?>
	
</div>


