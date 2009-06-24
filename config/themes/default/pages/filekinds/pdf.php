<?php
	// This is not very DRY (also used in files_and_foder) we have to refactor it...
	// Also, we should remove any logic from views...
	
	// Kind
	$file_kind = $this->filekind->get_kind_by_file($file->name);
	$kind = isset($file_kind['kind']) ? $file_kind['kind'] : '';
	$kind_display = isset($file_kind['display']) ? $file_kind['display'] : '—';
	
	// Comment
	$comment  = $this->filebrowser->get_item_property($this->filebrowser->file, 'comment') ? $this->filebrowser->get_item_property($this->filebrowser->file, 'comment') : '';
  
	// File size (weight)
	$filesize = format::filesize($file->stats['size']) ? format::filesize($file->stats['size']) : "—";

	// PDF dimensions
	// Defaults
	$width = isset($file_kind['width']) ? $file_kind['width'] : 640; 
	$height = isset($file_kind['height']) ? $file_kind['height'] : 480;
	// Specific to this file
	$width = $this->filebrowser->get_item_property($this->filebrowser->file, 'width') ? $this->filebrowser->get_item_property($this->filebrowser->file, 'width') : $width;
	$height = $this->filebrowser->get_item_property($this->filebrowser->file, 'height') ? $this->filebrowser->get_item_property($this->filebrowser->file, 'height') : $height;
?>

<object type="application/pdf" data="<?php echo $this->filebrowser->get_file_url(); ?>" width="<?php echo $width ?>" height="<?php echo $height ?>">
  <?php if ($file_kind && isset($file_kind['instructions'])) { ?>
	<p id='instructions'>Instructions: <?php echo format::get_rendered_text($file_kind['instructions']) ?></p>
	<?php } ?>
</object>
</div></body></html>

<!-- embed src="<?php echo $this->filebrowser->get_file_url(); ?>" width="<?php echo $width ?>" height="<?php echo $height ?>" -->
	
<?php require("_hideable_download_box.php") ?>