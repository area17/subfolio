<?php 
// -------------------- IMAGE GALLERY -----------------------------------------------------------------------------
$files   = $this->filebrowser->get_file_list("img");
if (sizeof($files) > 0) { 
  $this->filebrowser->set_displayed_content(true);
?>
<div id="gallery" >
  <ul>
  <?php foreach ($files as $file) { 
		if ($file->needs_thumbnail()) { $image_source = $file->get_thumbnail_url(); } else { $image_source = $file->get_url(); }
			if ($file->has_custom_thumbnail()) { 
			// Custom thumbnails -----------------------------------------------------------------------------
			?>
      <li>
        <a href="<?php echo $this->filebrowser->get_link($file->name); ?>">
					<div class="gallery_thumbnail">
						<img src="<?php echo $image_source ?>" />
					</div>
        	<p><?php echo $file->name ?></p>
				</a>
      </li>
    	<?php } else { 
			// Genrerated or not thumbnails -----------------------------------------------------------------------------
			?>
	    <li>
        <a href="<?php echo $this->filebrowser->get_link($file->name); ?>">
					<div class="gallery_thumbnail generated">
						<div class='hcenterer' style="width:<?php echo $file->get_width(); ?>px;">
							<div class="vcenterer">
								<img src="<?php echo $image_source ?>" />
							</div>
						</div>
					</div>
        	<p><?php echo $file->name ?></p>
				</a>
      </li>
			<?php	}
		} ?>
  </ul>
</div>
<?php } ?>
