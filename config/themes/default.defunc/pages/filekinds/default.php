<?php
  $display_info = view::get_option('display_info', true);
	// This is not very DRY (also used in files_and_foder) we have to refactor it...
	// Also, we should remove any logic from views...
	
	// Kind
	$file_kind = $this->filekind->get_kind_by_file($file->name);
	$kind = isset($file_kind['kind']) ? $file_kind['kind'] : '';
	$kind_display = isset($file_kind['display']) ? $file_kind['display'] : '—';
	
	// New and Update tags
	$new = false;
	$new_updated_start = $this->filebrowser->get_updated_since_time();
  $updated = false;
  if (false && $file->stats['ctime'] > $new_updated_start) {
      $new = true;
  } else if ($file->stats['mtime'] > $new_updated_start) {
      $updated = true;
  }

	// Icon
	$icon_file = "";
	$icon_file = $this->filekind->get_icon_by_file($file_kind);
  $icon = view::get_view_url()."/images/icons/grid/".$icon_file.".png";
	
	// Comment
	$comment  = $this->filebrowser->get_item_property($this->filebrowser->file, 'comment') ? $this->filebrowser->get_item_property($this->filebrowser->file, 'comment') : '';
  
	// File size (weight)
	$filesize = format::filesize($file->stats['size']) ? format::filesize($file->stats['size']) : "—";

// Show download box
?>
<?php //if ($display_info) { ?>
<?php require("_download_box.php");?>
<?php //} ?>