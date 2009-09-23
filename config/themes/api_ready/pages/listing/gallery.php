<?php if (API_HaveGalleryImages()) : ?>

	<div id="gallery" >
	  <ul>
			<?php foreach ( API_GalleryImages() as $image) : ?>
			
        <li>
          <a href="<?php echo $image['link']; ?>">
  					<div class="gallery_thumbnail <?php echo $image['class'] ?>" style="width:<?php echo $image['width']."px"; ?>">
  						<img width="<?php echo $image['width']."px" ?>" height="<?php echo $image['height']."px" ?>" src="<?php echo $image['url'] ?>" />
  					</div>
  					<?php if (API_Option['display_file_names_in_gallery']) { ?>
          	  <p><?php echo $image['filename'] ?></p>
          	<?php } ?>
  				</a>
        </li>
			
			<?php endforeach; ?>
		</ul>
	</div><!-- gallery -->

<?php endif ?>