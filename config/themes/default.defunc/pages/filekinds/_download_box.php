<?php
  $replace_dash_space = view::get_option('replace_dash_space', true);
  $replace_underscore_space = view::get_option('replace_underscore_space', true);
  $display_file_extensions = view::get_option('display_file_extensions', true);
?>
<div id="download_box">
		
	<a id="clickable-zone" href="<?php echo $this->filebrowser->get_file_url(); ?>?download=true">
		<!-- Icon -->
		<?php	if (isset($updated) && $updated) { ?>
			<span class="updated"><!-- --></span>
		<?php	} ?>
		<?php	if (isset($new) && $new) { ?>
			<span class="new"><!-- --></span>
		<?php	} ?>
		<?php	if (isset($icon) && $icon <> '') { ?>
		<img width='32' height='32' src='<?php echo $icon; ?>' />
		<?php } ?>
		<!-- Filename / comment -->
		<p id="filename"><?php echo htmlentities(FileFolder::fix_display_name($this->filebrowser->file, $replace_dash_space, $replace_underscore_space, $display_file_extensions)) ?></p>
		
		<?php	if (isset($comment) && $comment <> '') { ?>
		<p><?php echo format::get_rendered_text($comment) ?></p>
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
		<p id='instructions'>Instructions: <?php echo $file_kind['instructions'] ?></p>
		<?php } ?>
	<?php } ?>
	<!-- Download -->
	<a href="<?php echo $this->filebrowser->get_file_url(); ?>?download=true" id="download">Download File</a>
	
</div>