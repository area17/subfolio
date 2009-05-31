<?php
$width = 640; 
$height = 480;

$width    = $this->filebrowser->get_item_property($this->filebrowser->file, 'width')    ? $this->filebrowser->get_item_property($this->filebrowser->file, 'width') : 640;
$height   = $this->filebrowser->get_item_property($this->filebrowser->file, 'height')   ? $this->filebrowser->get_item_property($this->filebrowser->file, 'height') : 480;

?>
<embed src="<?php echo $this->filebrowser->get_file_url(); ?>" width="<?php echo $width ?>" height="<?php echo $height ?>">

<?php  
	$file_kind = $this->filekind->get_kind_by_file($file->name);
?>
<?php if ($file_kind && isset($file_kind['instructions'])) { ?>
<p id='instructions'>Instructions: <?php echo $file_kind['instructions'] ?></p>
<?php } ?>
  
<p><a href="<?php echo $this->filebrowser->get_file_url(); ?>">Download</a></p>