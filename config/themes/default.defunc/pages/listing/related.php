<?php
// ****************************** RELATED ******************************
$listing_mode = Kohana::config('filebrowser.listing_mode');
$listing_mode = view::get_option('listing_mode', $listing_mode);

$inline = $this->filebrowser->get_file_list("cut", null, true);
if (sizeof($inline) > 0) { 
	?>
	<div id="related">
		<p>See also:</p>
		<ul class="<?php echo $listing_mode ?>">
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
					<span class="icon">
						<?php
						// to be confirmed
						if (strstr($_SERVER['HTTP_USER_AGENT'],'iPhone') || strstr($_SERVER['HTTP_USER_AGENT'],'iPod')) {
							$listing_mode = 'grid';
						} ?>
						<!-- <span class="icon_download blank"></span> -->
						<img src='<?php echo view::get_view_url() ?>/images/icons/<?php echo $listing_mode; ?>/i_cut.png' width='18' height='17' class='download_arrow' />
					</span>
					<span class="filename"><?php echo format::filename($name, false) ?></span>
				</a>
			</li>
		<?php 
	  } ?>
	  </ul>
  </div>
  <?php
} ?>