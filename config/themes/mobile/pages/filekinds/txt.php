<div class="file file_txt">

	<!-- File -->
	<div class="file_preview">
		<div id="inline_top_text" class="standard_paragraph">
			<?php echo Subfolio::current_file('body') ?>
		</div>
	</div>
	<!-- Information -->
	<?php if (SubfolioTheme::get_option('display_info')) { require("_download_box.php"); } ?>
	
</div>