<?php
	// This is not very DRY (also used in files_and_foder) we have to refactor it...
	// Also, we should remove any logic from views...
	$new_updated_start = $this->filebrowser->get_updated_since_time();
	$file_kind = $this->filekind->get_kind_by_file($file->name);
	$kind = isset($file_kind['kind']) ? $file_kind['kind'] : '';
	$kind_display = isset($file_kind['display']) ? $file_kind['display'] : '—';
	$icon_file = "";
	$comment  = $this->filebrowser->get_item_property($this->filebrowser->file, 'comment') ? $this->filebrowser->get_item_property($this->filebrowser->file, 'comment') : '';
  
	$filesize = format::filesize($file->stats['size']);
	$filesize = format::filesize($file->stats['size']) ? format::filesize($file->stats['size']) : "—";
	list($width, $height, $type, $attr) = getimagesize($this->filebrowser->fullfolderpath."/".$file->name);
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

<img width='<?php echo $width ?>' height='<?php echo $height ?>' src='<?php echo $this->filebrowser->get_file_url(); ?>' />

<?php require("_hideable_download_box.php") ?>