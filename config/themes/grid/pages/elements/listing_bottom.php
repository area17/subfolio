<?php
$inline = $this->filebrowser->get_file_list("cut", null, true);
if (sizeof($inline) > 0) { 
	?>
	<div id="related">see also:
	<ul>
	<?php
	foreach($inline as $file) {
		$url = $this->filebrowser->get_item_property($file->name, 'url');
	    if ($url == "") {
	      $url = $this->filebrowser->get_item_property($file->name, 'directory');
	    }
	    $name = $this->filebrowser->get_item_property($file->name, 'name');
	  	?>
		<li>
			<a href='<?php echo $url ?>'>
				<div class="listing-content">
					<span class="listing-content-left">
						<span class="listing-content-left-inner">
							<span class="icon column">
								<span class="icon_download blank"><!-- --></span>
								<img src='<?php echo view::get_view_url() ?>/images/icons/i_cut.png' width='18' height='17' class='download_arrow' />
							</span>
							<span class="filename column"><?php echo format::filename($name, false) ?>
							</span>						
						</span>
					</span>
					
				</div>
			</a>
		</li>
	<?php 
  } ?>
  </ul>
  </div>
  <?php
} ?>

<!-- INLINE TEXT --->

<?php if ($this->filebrowser->get_folder_property('text-bottom') <> '') { ?>
<div class="bottom-text">
  <?php echo $this->filebrowser->get_folder_property('text-bottom') ?>
</div>
<?php } ?>

<?php 
$inline = $this->filebrowser->get_file_list("txt", "-t-bottom", true);
if (sizeof($inline) > 0) { 
  $this->filebrowser->set_displayed_content(true);
  foreach($inline as $file) {
    ?>
    <div id="bottom-text">
    <?php
      readfile($file->name);
    ?>
    </div>
    <?php
  }
} ?>
