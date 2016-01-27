<?php if (!SubfolioFiles::is_root()) { ?>
<div id="navigation">
	<span class="parent_dir">
		<?php echo SubfolioFiles::parent_link("&#8592; ".SubfolioLanguage::get_text('parent_directory')); ?>
  </span>
	<span class="prev_next">
		<?php echo SubfolioFiles::previous_link_or_span(SubfolioLanguage::get_text('previous'), SubfolioLanguage::get_text('previous'), 'previous', 'faded'); ?><?php echo SubfolioFiles::next_link_or_span(SubfolioLanguage::get_text('next'), SubfolioLanguage::get_text('next'), 'next', 'faded'); ?>
	</span>
</div>
<?php } ?>
