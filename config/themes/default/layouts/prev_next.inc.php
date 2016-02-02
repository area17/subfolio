<?php if (!SubfolioFiles::is_root()) { ?>
<div class="header__navigation">
    <?php echo SubfolioFiles::previous_link_or_span("&larr; &nbsp; ".SubfolioLanguage::get_text('previous'), "&larr; &nbsp; ".SubfolioLanguage::get_text('previous'), 'previous', 'faded'); ?><?php echo SubfolioFiles::next_link_or_span(SubfolioLanguage::get_text('next')." &nbsp; &rarr;", SubfolioLanguage::get_text('next')." &nbsp; &rarr;", 'next', 'faded'); ?>
</div>
<?php } ?>
