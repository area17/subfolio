<?php if (!SubfolioFiles::is_root()) { ?>
<div class="header__navigation" id="navigation">
	<span class="parent_dir">
		<?php echo SubfolioFiles::parent_link("&uarr; &nbsp; ".SubfolioLanguage::get_text('parent_directory')); ?>
  </span>
	<span class="prev_next">
		<?php echo SubfolioFiles::previous_link_or_span("&larr; &nbsp; ".SubfolioLanguage::get_text('previous'), "&larr; &nbsp; ".SubfolioLanguage::get_text('previous'), 'previous', 'faded'); ?><?php echo SubfolioFiles::next_link_or_span(SubfolioLanguage::get_text('next')." &nbsp; &rarr;", SubfolioLanguage::get_text('next')." &nbsp; &rarr;", 'next', 'faded'); ?>
	</span>
</div>
<?php } ?>
