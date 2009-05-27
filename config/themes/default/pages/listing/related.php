<?php
// ****************************** RELATED ******************************

$inline = $this->filebrowser->get_file_list("cut", null, true);
if (sizeof($inline) > 0) { 
	?>
	<div id="related">
		<p>See also:</p>
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