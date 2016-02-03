<?php if (!SubfolioFiles::is_root()) { ?>
<div class="header__navigation">
    <?php echo SubfolioFiles::previous_link_or_span("<i class='icon icon__arrow_left'>&larr;</i>", "<i class='icon icon__arrow_left'>&larr;</i>", 'previous', 'faded'); ?><?php echo SubfolioFiles::next_link_or_span("<i class='icon icon__arrow_right'>&rarr;</i>", "<i class='icon icon__arrow_right'>&rarr;</i>", 'next', 'faded'); ?>
</div>
<?php } ?>
