<?php
$file_kind = $this->filekind->get_kind_by_file($file->name);

$width    = isset($file_kind['width']) ? $file_kind['width'] : 640; 
$height   = isset($file_kind['height']) ? $file_kind['height'] : 480;
$autoplay = isset($file_kind['autoplay']) ? $file_kind['autoplay'] : 'false';

$width    = $this->filebrowser->get_item_property($this->filebrowser->file, 'width')    ? $this->filebrowser->get_item_property($this->filebrowser->file, 'width') : $width;
$height   = $this->filebrowser->get_item_property($this->filebrowser->file, 'height')   ? $this->filebrowser->get_item_property($this->filebrowser->file, 'height') : $height;
$autoplay = $this->filebrowser->get_item_property($this->filebrowser->file, 'autoplay') ? $this->filebrowser->get_item_property($this->filebrowser->file, 'autoplay') : $autoplay;
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
