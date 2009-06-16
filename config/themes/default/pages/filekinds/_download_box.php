<div id="download_box">
		
	<a id="clickable-zone" href="<?php echo $this->filebrowser->get_file_url(); ?>">
		<!-- Icon -->
		<?php	if (isset($updated) && $updated) { ?>
			<span class="updated"><!-- --></span>
		<?php	} ?>
		<?php	if (isset($new) && $new) { ?>
			<span class="new"><!-- --></span>
		<?php	} ?>
		<?php	if (isset($icon) && $icon <> '') { ?>
		<img src='<?php echo $icon; ?>' />
		<?php } ?>
		<!-- Filename / comment -->
		<p id="filename"><?php echo $this->filebrowser->file ?></p>
		<?php	if (isset($comment) && $comment <> '') { ?>
		<p><?php echo $comment ?></p>
		<?php } ?>
	</a>

	<?php	if (isset($kind)) { ?>
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
	<?php } ?>
	<a href="<?php echo $this->filebrowser->get_file_url(); ?>" id="download">Download</a>
	
</div>