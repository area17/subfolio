<EMBED 
  src='<?php echo Subfolio::current_file('url') ?>' 
  autoplay=<?php echo Subfolio::current_file('autoplay') ?>
  quality=high 
  width='<?php echo Subfolio::current_file('width') ?>' 
  height='<?php echo Subfolio::current_file('height') ?>' 
  scale='noscale' 
  TYPE='application/x-shockwave-flash' 
  PLUGINSPAGE='http://public.macromedia.com/go/getflashplayer'>
</EMBED>

<?php if (SubfolioTheme::get_option('display_info')) { require("_hideable_download_box.php"); } ?>