<?php
$width = 640; 
$height = 480;

$width    = $this->filebrowser->get_item_property($this->filebrowser->file, 'width')    ? $this->filebrowser->get_item_property($this->filebrowser->file, 'width') : 640;
$height   = $this->filebrowser->get_item_property($this->filebrowser->file, 'height')   ? $this->filebrowser->get_item_property($this->filebrowser->file, 'height') : 480;

?>
<EMBED 
  src='<?php echo $this->filebrowser->get_file_url(); ?>' 
  quality=high 
  width='<?php echo $width ?>' 
  height='<?php echo $height?>' 
  scale='noscale' 
  TYPE='application/x-shockwave-flash' 
  PLUGINSPAGE='http://public.macromedia.com/go/getflashplayer'>
</EMBED>