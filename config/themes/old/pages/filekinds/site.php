<div id="download_box">
		
	<a id="clickable-zone" href="<?php echo Subfolio::current_file('link') ?>" target="<?php echo Subfolio::current_file('target') ?>">
		<!-- ?download=true would be provided by the CurrentFile() method -->
		<!-- By adding an option for target, we can use this box for more kinds... (links for example) -->
		
		<!-- Tag -->
		<span class="<?php echo Subfolio::current_file('tag') ?>"><!-- --></span>
		<!-- Icon -->
		<img width='32' height='32' src='<?php echo Subfolio::current_file('icon') ?>' />
		<!-- Filename / comment -->
		<p id="filename"><?php echo Subfolio::current_file('filename') ?></p>
	</a>
	<dl>
		<dt><?php echo SubfolioLanguage::get_text('kind') ?></dt><dd><?php echo Subfolio::current_file('kind') ?></dd>
		<dt><?php echo SubfolioLanguage::get_text('lastmodified') ?></dt><dd><?php echo Subfolio::current_file('lastmodified') ?></dd>
		<dt><?php echo SubfolioLanguage::get_text('size') ?></dt><dd><?php echo Subfolio::current_file('size') ?></dd>
		<dt><?php echo SubfolioLanguage::get_text('comment') ?></dt><dd><?php echo Subfolio::current_file('comment') ?></dd>
	</dl>
	
</div>