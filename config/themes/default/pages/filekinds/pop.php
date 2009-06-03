<?php
  $width    = $this->filebrowser->get_item_property($this->filebrowser->file, 'width')    ? $this->filebrowser->get_item_property($this->filebrowser->file, 'width') : 800;
  $height   = $this->filebrowser->get_item_property($this->filebrowser->file, 'height')   ? $this->filebrowser->get_item_property($this->filebrowser->file, 'height') : 600;
  $url      = $this->filebrowser->get_item_property($this->filebrowser->file, 'url')      ? $this->filebrowser->get_item_property($this->filebrowser->file, 'url') : 'http://www.subfolio.com';
  $name     = $this->filebrowser->get_item_property($this->filebrowser->file, 'name')     ? $this->filebrowser->get_item_property($this->filebrowser->file, 'name') : 'POPUP';
  $style    = $this->filebrowser->get_item_property($this->filebrowser->file, 'style')    ? $this->filebrowser->get_item_property($this->filebrowser->file, 'style') : 'POPSCROLL';

  $url = "javascript:pop('$url','$name',$width,$height,'$style');";
?>

<?php
	// This is not very DRY (also used in files_and_foder) we have to refactor it...
	// Also, we should remove any logic from views...
	$new_updated_start = $this->filebrowser->get_updated_since_time();
	$file_kind = $this->filekind->get_kind_by_file($file->name);
	$kind = isset($file_kind['kind']) ? $file_kind['kind'] : '';
	$kind_display = isset($file_kind['display']) ? $file_kind['display'] : '—';
	$icon_file = "";
	$comment  = $this->filebrowser->get_item_property($this->filebrowser->file, 'comment') ? $this->filebrowser->get_item_property($this->filebrowser->file, 'comment') : '';
  
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
		
	<a id="clickable-zone" href="<?php echo $url; ?>">
		<!-- Icon -->
		<img src='<?php echo $icon; ?>' />
		<!-- Filename / comment -->
		<p id="filename"><?php echo $this->filebrowser->file ?></p>
		<p><?php echo $comment ?></p>
	</a>
	
</div>