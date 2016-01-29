<EMBED 
  src='<?php echo Subfolio::current_file('url') ?>' 
  autoplay=<?php echo Subfolio::current_file('autoplay') ?>
  pluginspage='http://public.apple.com/quicktime/' 
  width='<?php echo Subfolio::current_file('width') ?>' 
  height='<?php echo Subfolio::current_file('height') ?>'
  scale='noscale' 
  controller='true'>
</EMBED>

<?php if (SubfolioTheme::get_option('display_info')) { require("_hideable_download_box.php"); } ?>