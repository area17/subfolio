<?php
$width    = $this->filebrowser->get_item_property($this->filebrowser->file, 'width')    ? $this->filebrowser->get_item_property($this->filebrowser->file, 'width') : 200;
$height   = $this->filebrowser->get_item_property($this->filebrowser->file, 'height')   ? $this->filebrowser->get_item_property($this->filebrowser->file, 'height') : 16;
$autoplay = $this->filebrowser->get_item_property($this->filebrowser->file, 'autoplay') ? $this->filebrowser->get_item_property($this->filebrowser->file, 'autoplay') : 'false';
?>
<EMBED 
  src='<?php echo $this->filebrowser->get_file_url(); ?>' 
  autoplay=<?php echo $autoplay ?>
  controller='true' 
  pluginspage='http://public.apple.com/quicktime/' 
  width='<?php echo $width ?>' 
  height='<?php echo $height?>' 
  scale='noscale' 
  controller='true' 
  pluginspage='http://public.apple.com/quicktime/'>
</EMBED>