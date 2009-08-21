<?php 

$display_filenames = view::get_option('display_file_names_in_gallery', true);

// -------------------- IMAGE GALLERY -----------------------------------------------------------------------------
$files   = $this->filebrowser->get_file_list("img");
if (sizeof($files) > 0) { 
  $this->filebrowser->set_displayed_content(true);
?>
<div id="gallery" >
  <ul>
  <?php foreach ($files as $file) { 
  		if ($file->needs_thumbnail()) { 
  		  $image_source = $file->get_thumbnail_url(); 
  		} else { 
    		$image_source = $file->get_url(); 
    	}

      list ($width, $height) = $file->get_gallery_width_height();
  
      if ($image_source <> '') {
  			if ($file->has_custom_thumbnail()) { 
  			// Custom thumbnails -----------------------------------------------------------------------------
  			?>
        <li>
          <a href="<?php echo $this->filebrowser->get_link($file->name); ?>">
  					<div class="gallery_thumbnail custom">
  						<img width="<?php echo $width ?>" height="<?php echo $height ?>" src="<?php echo $image_source ?>" />
  					</div>
  					<?php if ($display_filenames) { ?>
          	  <p><?php echo $file->name ?></p>
          	<?php } ?>
  				</a>
        </li>
      	<?php } else { 
  			// Genrerated or not thumbnails -----------------------------------------------------------------------------
  			?>
  	    <li>
          <a href="<?php echo $this->filebrowser->get_link($file->name); ?>">
  					<div class="gallery_thumbnail" style="width:<?php echo $width."px"; ?>">
  						<img width="<?php echo $width ?>"  height="<?php echo $height ?>" src="<?php echo $image_source ?>" />
  					</div>
  					<?php if ($display_filenames) { ?>
            	<p><?php echo $file->name ?></p>
          	<?php } ?>
  				</a>
        </li>
  			<?php	}
			}
		} ?>
  </ul>
</div>
<?php } ?>
