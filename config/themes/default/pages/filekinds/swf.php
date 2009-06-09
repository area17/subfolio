<?php
$file_kind = $this->filekind->get_kind_by_file($file->name);

$width    = isset($file_kind['width']) ? $file_kind['width'] : 640; 
$height   = isset($file_kind['height']) ? $file_kind['height'] : 480;

$width    = $this->filebrowser->get_item_property($this->filebrowser->file, 'width')    ? $this->filebrowser->get_item_property($this->filebrowser->file, 'width') : $width;
$height   = $this->filebrowser->get_item_property($this->filebrowser->file, 'height')   ? $this->filebrowser->get_item_property($this->filebrowser->file, 'height') : $height;

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

<!-- Download -->
<div id="download_box">
	<a href="<?php echo $this->filebrowser->get_file_url(); ?>" id="download" class="with_arrow">Download</a>
</div>