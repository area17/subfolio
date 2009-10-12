<EMBED 
  src='<?php echo Subfolio::current_file('url') ?>' 
  autoplay=<?php echo Subfolio::current_file('autoplay') ?>
  controller='true' 
  pluginspage='http://public.apple.com/quicktime/' 
  width='<?php echo Subfolio::current_file('width') ?>' 
  height='<?php echo Subfolio::current_file('height') ?>' 
  scale='noscale' 
  controller='true' 
  pluginspage='http://public.apple.com/quicktime/'>
</EMBED>

<?php if (SubfolioTheme::get_option('display_info')) { require("_download_box.php") } ?>