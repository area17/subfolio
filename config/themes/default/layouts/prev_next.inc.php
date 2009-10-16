<?php if (!SubfolioFiles::is_root()) { ?>
<div id="navigation">
	<span class="parent_dir">
		<?php echo SubfolioFiles::parent_link(SubfolioLanguage::get_text('parent_directory')); ?>
  </span>
	<span class="prev_next">		
		<?php echo SubfolioFiles::previous_link_or_span(SubfolioLanguage::get_text('Previous'), SubfolioLanguage::get_text('previous_directory'), SubfolioLanguage::get_text('previous'), 'faded'); ?><?php echo SubfolioFiles::next_link_or_span(SubfolioLanguage::get_text('Next'), SubfolioLanguage::get_text('next_directory'), SubfolioLanguage::get_text('previous'), 'faded'); ?>
	</span>
</div>
<?php } ?>
