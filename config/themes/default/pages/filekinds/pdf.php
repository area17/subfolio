<?php
$width = 640; 
$height = 480;

$width    = $this->filebrowser->get_item_property($this->filebrowser->file, 'width')    ? $this->filebrowser->get_item_property($this->filebrowser->file, 'width') : 640;
$height   = $this->filebrowser->get_item_property($this->filebrowser->file, 'height')   ? $this->filebrowser->get_item_property($this->filebrowser->file, 'height') : 480;

?>
<embed src="<?php echo $this->filebrowser->get_file_url(); ?>" width="<?php echo $width ?>" height="<?php echo $height ?>">
<p><a href="<?php echo $this->filebrowser->get_file_url(); ?>">Download</a></p>