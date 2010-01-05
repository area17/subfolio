<?php
$max_size = Subfolio::get_setting('display_max_filesize');
$size = Subfolio::current_file('rawsize');
$width = Subfolio::current_file('width');
?>

<div class="file file_img">

	<?php if ($size < ($max_size * 1024 * 1024)) { ?>
		
		<!-- File preview -->
		<div class="file_preview" style='max-width:<?php echo $width ?>px;'>
			<a href="<?php echo Subfolio::current_file('link') ?>">
				<img src="<?php echo Subfolio::current_file('url') ?>" alt="" />
			</a>
		</div>
		<!-- Information -->
		<?php if (SubfolioTheme::get_option('display_info')) { require("_download_box.php"); } ?>
			
	<?php
 	} else {
		require("_download_box.php");
	} ?>
	
</div>