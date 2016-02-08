<div id="download_box">

	<a id="clickable-zone" href="<?php echo Subfolio::current_file('link') ?>" target="<?php echo Subfolio::current_file('target') ?>">
		<!-- ?download=true would be provided by the CurrentFile() method -->
		<!-- By adding an option for target, we can use this box for more kinds... (links for example) -->
		<!-- Icon -->
		<i class='icon icon__<?php echo Subfolio::current_file('icon') ?>'></i>
		<!-- Filename / comment -->
		<p id="filename"><i class="tag <?php echo Subfolio::current_file('tag') ?>"></i> &nbsp; <?php echo Subfolio::current_file('filename') ?></p>
	</a>
	<dl>
		<dt><?php echo SubfolioLanguage::get_text('kind') ?></dt><dd><?php echo Subfolio::current_file('kind') ?></dd>
		<dt><?php echo SubfolioLanguage::get_text('lastmodified') ?></dt><dd><?php echo Subfolio::current_file('lastmodified') ?></dd>
		<dt><?php echo SubfolioLanguage::get_text('size') ?></dt><dd><?php echo Subfolio::current_file('size') ?></dd>
		<dt><?php echo SubfolioLanguage::get_text('comment') ?></dt><dd><?php echo Subfolio::current_file('comment') ?></dd>
	</dl>
	<p id='instructions'><?php echo Subfolio::current_file('instructions') ?></p>
	<a id="download" href="<?php echo Subfolio::current_file('link') ?>?download=true" target="<?php echo Subfolio::current_file('target') ?>"><?php echo SubfolioLanguage::get_text('downloadfile') ?></a>
	<!-- Link_name can be open or download. These words taken from the language file... -->

</div>