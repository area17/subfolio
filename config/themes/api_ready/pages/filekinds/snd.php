<EMBED 
  src='<?php echo API_CurrentFile('url') ?>' 
  autoplay=<?php echo API_CurrentFile('autoplay') ?>
  controller='true' 
  pluginspage='http://public.apple.com/quicktime/' 
  width='<?php echo API_CurrentFile('width') ?>' 
  height='<?php echo API_CurrentFile('height') ?>' 
  scale='noscale' 
  controller='true' 
  pluginspage='http://public.apple.com/quicktime/'>
</EMBED>

<?php if (API_Option('display_info')) { require("_download_box.php") } ?>