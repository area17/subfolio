<?php
$file_kind = $this->filekind->get_kind_by_file($file->name);

$width = isset($file_kind['width']) ? $file_kind['width'] : 640; 
$height = isset($file_kind['height']) ? $file_kind['height'] : 480;

$width    = $this->filebrowser->get_item_property($this->filebrowser->file, 'width')    ? $this->filebrowser->get_item_property($this->filebrowser->file, 'width') : $width;
$height   = $this->filebrowser->get_item_property($this->filebrowser->file, 'height')   ? $this->filebrowser->get_item_property($this->filebrowser->file, 'height') : $height;

?>
<embed src="<?php echo $this->filebrowser->get_file_url(); ?>" width="<?php echo $width ?>" height="<?php echo $height ?>">

<?php
	// This is not very DRY (also used in files_and_foder) we have to refactor it...
	// Also, we should remove any logic from views...
	$new_updated_start = $this->filebrowser->get_updated_since_time();
	$kind = isset($file_kind['kind']) ? $file_kind['kind'] : '';
	$kind_display = isset($file_kind['display']) ? $file_kind['display'] : '—';
	$comment  = $this->filebrowser->get_item_property($this->filebrowser->file, 'comment') ? $this->filebrowser->get_item_property($this->filebrowser->file, 'comment') : '';
	$filesize = format::filesize($file->stats['size']);
	$filesize = format::filesize($file->stats['size']) ? format::filesize($file->stats['size']) : "—";
	$new = false;
  $updated = false;
  if (false && $file->stats['ctime'] > $new_updated_start) {
      $new = true;
  } else if ($file->stats['mtime'] > $new_updated_start) {
      $updated = true;
  }
?>
	
<div id="download_box">

	<a id="clickable-zone" href="<?php echo $this->filebrowser->get_file_url(); ?>">
		<!-- Filename / comment -->
		<p><?php echo $comment ?></p>
	</a>

	<!-- Infos -->
	<dl>
		<dt>Kind: </dt><dd><?php echo $kind_display ?></dd>
		<dt>Last modified: </dt><dd><?php echo format::filedate($file->stats['mtime']) ?></dd>
		<dt>Size: </dt><dd><?php echo $filesize ?></dd>
	</dl>
	<!-- Instructions -->
  <?php if ($file_kind && isset($file_kind['instructions'])) { ?>
	<p id='instructions'>Instructions: <?php echo format::get_rendered_text($file_kind['instructions']) ?></p>
	<?php } ?>
	<!-- Download -->
	<a href="<?php echo $this->filebrowser->get_file_url(); ?>" id="download">Download</a>

</div>