<div id="info">
	<a href="javascript:InfoHideSwitch('info-box','info-button');" id="info-button" class="">Info</a>
	<div id="info-box" class="hide">
		<div id="download_box">
			<a id="clickable-zone" href="<?php echo $this->filebrowser->get_file_url(); ?>">
				<!-- Filename / comment -->
				<p id="filename"><?php echo $this->filebrowser->file ?></p>
				<p><?php echo format::get_rendered_text($comment) ?></p>
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
			<a href="<?php echo $this->filebrowser->get_file_url(); ?>?download=true" id="download">Download</a>
		</div>	
	</div>
</div>
