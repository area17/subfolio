<?php
	// This is not very DRY (also used in files_and_foder) we have to refactor it...
	// Also, we should remove any logic from views...
	
	// Kind
	$file_kind = $this->filekind->get_kind_by_file($folder);
	$kind = isset($file_kind['kind']) ? $file_kind['kind'] : '';
	$kind_display = isset($file_kind['display']) ? $file_kind['display'] : '—';

	// Icon
	$icon_file = "";
	$icon_file = $this->filekind->get_icon_by_file($file_kind);
  $icon = view::get_view_url()."/images/icons/big/".$icon_file.".png";

	// Comment
	$comment  = $this->filebrowser->get_item_property($this->filebrowser->file, 'comment') ? $this->filebrowser->get_item_property($this->filebrowser->file, 'comment') : '';

	// Site
	$url = "/directory/".$folder."/index.html";
	$target = "_blank";

?>

<div id="download_box">
		
	<a id="clickable-zone" target="<?php echo $target; ?>" href="<?php echo $url; ?>">
		<!-- Icon -->
		<?php	if (isset($icon) && $icon <> '') { ?>
			<img src='<?php echo $icon; ?>' />
		<?php } ?>
		<!-- Filename / comment -->
		<p id="filename"><?php echo $this->filebrowser->file ?>We are missing the filename here!</p>
		<?php	if (isset($comment) && $comment <> '') { ?>
			<p><?php echo format::get_rendered_text($comment) ?></p>
		<?php } ?>
	</a>

	<?php	if (isset($kind)) { ?>
		<!-- Infos -->
		<dl>
			<dt>Kind: </dt><dd><?php echo $kind_display ?></dd>
		</dl>
	<?php } ?>
	<!-- Open -->
	<a target="<?php echo $target; ?>" href="<?php echo $url; ?>" id="download">Open site</a>
	
</div>
