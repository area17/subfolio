<EMBED 
  src='<?php echo API_CurrentFile('url') ?>' 
  quality=high 
  width='<?php echo API_CurrentFile('width') ?>' 
  height='<?php echo API_CurrentFile('height') ?>' 
  scale='noscale' 
  TYPE='application/x-shockwave-flash' 
  PLUGINSPAGE='http://public.macromedia.com/go/getflashplayer'>
</EMBED>

<?php if (API_Option('display_info')) { require("_download_box.php") } ?>