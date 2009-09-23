<div id="download_box">
		
	<a id="clickable-zone" href="<?php echo API_CurrentFile('link') ?>" target="<?php echo API_CurrentFile('target') ?>">
		<!-- ?download=true would be provided by the CurrentFile() method -->
		<!-- By adding an option for target, we can use this box for more kinds... (links for example) -->
		
		<!-- Tag -->
		<span class="<?php API_CurrentFile('tag') ?>"><!-- --></span>
		<!-- Icon -->
		<img width='32' height='32' src='<?php echo API_CurrentFile('icon') ?>' />
		<!-- Filename / comment -->
		<p id="filename"><?php echo API_CurrentFile('filename') ?></p>
	</a>
	<dl>
		<dt><?php echo API_Language('filebrowser.kind') ?></dt><dd><?php echo API_CurrentFile('kind') ?></dd>
		<dt><?php echo API_Language('filebrowser.lastmodified') ?></dt><dd><?php echo API_CurrentFile('lastmodified') ?></dd>
		<dt><?php echo API_Language('filebrowser.size') ?></dt><dd><?php echo API_CurrentFile('size') ?></dd>
	</dl>
	<p><?php echo API_Language('filebrowser.instructions') ?></dt><dd><?php echo API_CurrentFile('instructions') ?></p>
	<a id="download" href="<?php echo API_CurrentFile('link') ?>" target="<?php echo API_CurrentFile('target') ?>"><?php echo API_CurrentFile('link_name') ?></a>
	<!-- Link_name can be open or download. These words taken from the language file... -->
	
</div>