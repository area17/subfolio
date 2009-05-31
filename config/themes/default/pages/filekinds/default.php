<?php
	// This is not very DRY (also used in files_and_foder) we have to refactor it...
	// Also, we should remove any logic from views...
	$new_updated_start = $this->filebrowser->get_updated_since_time();
	$file_kind = $this->filekind->get_kind_by_file($file->name);
	$kind_display = isset($file_kind['display']) ? $file_kind['display'] : '';
	$icon_file = "";
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
  $icon_file = $this->filekind->get_icon_by_file($file_kind, $new, $updated);
  $icon = view::get_view_url()."/images/icons/big/".$icon_file.".png";
?>

<div id="download_box">
	<!-- Icon -->
	<?php	if ($updated) { ?>
		<span class="updated"><!-- --></span>
	<?php	} ?>
	<?php	if ($new) { ?>
		<span class="new"><!-- --></span>
	<?php	} ?>
	<a href="<?php echo $this->filebrowser->get_file_url(); ?>"><img src='<?php echo $icon; ?>' /></a>
	<!-- Filename -->
	<div id="filename">
		<p><a href="<?php echo $this->filebrowser->get_file_url(); ?>"><?php echo $this->filebrowser->file ?></a></p>
	</div>
	<p><?php echo $comment ?></p>
	<!-- Infos -->
	<dl>
		<dt>Kind: </dt><dd><?php echo $kind_display ?></dd>
		<dt>Last modified: </dt><dd><?php echo format::filedate($file->stats['mtime']) ?></dd>
		<dt>Size: </dt><dd><?php echo $filesize ?></dd>
	</dl>
	<!-- Instructions -->
  <?php if ($file_kind && isset($file_kind['instructions'])) { ?>
	<p id='instructions'>Instructions: <?php echo $file_kind['instructions'] ?></p>
	<?php } ?>
	<!-- Download -->
	<a href="<?php echo $this->filebrowser->get_file_url(); ?>" id="download">Download</a>
	
</div>

