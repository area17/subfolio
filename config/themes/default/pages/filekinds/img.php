<img width="<?php echo Subfolio::current_file('width') ?>" height="<?php echo Subfolio::current_file('height') ?>" src="<?php echo Subfolio::current_file('url') ?>" />

<?php if (SubfolioTheme::get_option('display_info')) { require("_hideable_download_box.php"); } ?>