<div class="file_meta icon icon_<?php echo Subfolio::current_file('icon_name') ?>">
	<h2 class="h1_file"><?php echo Subfolio::current_file('filename') ?></h2>
	<?php if (Subfolio::current_file('comment')<>'-') { ?>
		<p><?php echo Subfolio::current_file('comment') ?></p>
	<?php } ?>
	<dl>
		<dt><?php echo SubfolioLanguage::get_text('kind') ?></dt><dd><?php echo Subfolio::current_file('kind') ?></dd>
		<dt><?php echo SubfolioLanguage::get_text('lastmodified') ?></dt><dd><?php echo Subfolio::current_file('lastmodified') ?></dd>
		<dt><?php echo SubfolioLanguage::get_text('size') ?></dt><dd><?php echo Subfolio::current_file('size') ?></dd>
	</dl>
	
	<!-- PDF -->
	<?php if (Subfolio::current_file('icon_name')=='pdf') { ?> 
		<a href="<?php echo Subfolio::current_file('link') ?>?download=true" class="btn btn_download"><?php echo SubfolioLanguage::get_text('downloadfile') ?></a>
	<?php }?>
	
	<!-- Image -->
	<?php if (Subfolio::current_file('icon_name')=='img') { ?> 
		<span href="<?php echo Subfolio::current_file('link') ?>" class="btn btn_download"><?php echo SubfolioLanguage::get_text('viewimage') ?></span>
	<?php }?>
	
</div>
