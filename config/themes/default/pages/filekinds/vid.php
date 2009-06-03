<?php
$width = 640; 
$height = 480;

$width    = $this->filebrowser->get_item_property($this->filebrowser->file, 'width')    ? $this->filebrowser->get_item_property($this->filebrowser->file, 'width') : 640;
$height   = $this->filebrowser->get_item_property($this->filebrowser->file, 'height')   ? $this->filebrowser->get_item_property($this->filebrowser->file, 'height') : 480;
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

<!-- Download -->
<div id="download_box">
	<a href="<?php echo $this->filebrowser->get_file_url(); ?>" id="download" class="with_arrow">Download</a>
</div>
