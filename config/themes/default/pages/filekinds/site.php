<?php
  $url = "/directory/".$folder."/index.html";
	$target = "_blank";
		
	$file_kind = $this->filekind->get_kind_by_file($folder);
	$kind = isset($file_kind['kind']) ? $file_kind['kind'] : '';	
	
	$kind_display = isset($file_kind['display']) ? $file_kind['display'] : '—';
	$icon_file = "";
	$comment  = $this->filebrowser->get_item_property("../".$folder, 'comment') ? $this->filebrowser->get_item_property("../".$folder, 'comment') : '';
	
	$icon_file = $this->filekind->get_icon_by_file($file_kind);
  $icon = view::get_view_url()."/images/icons/big/".$icon_file.".png";
?>
<a target="<?php echo $target ?>" href="<?php echo $url ?>">Open Site</a>

<div id="download_box">
		
	<a id="clickable-zone" target="<?php echo $target ?>"  href="<?php echo $url ?>">
		<!-- Icon -->
		<img src='<?php echo $icon; ?>' />
		<!-- Filename / comment -->
		<p id="filename"><?php echo $this->filebrowser->file ?></p>
		<p><?php echo format::get_rendered_text($comment) ?></p>
	</a>
	
	<!-- Infos -->
	<dl>
		<dt>Kind: </dt><dd><?php echo $kind_display ?></dd>
	</dl>
	<!-- Instructions -->
  <?php if ($file_kind && isset($file_kind['instructions'])) { ?>
	<p id='instructions'>Instructions: <?php echo format::get_rendered_text($file_kind['instructions']) ?></p>
	<?php } ?>
	<!-- Download -->
	<a target="<?php echo $target ?>" href="<?php echo $url; ?>" id="download">Open Site</a>
	
</div>