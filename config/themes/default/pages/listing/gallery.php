<?php if (SubfolioFiles::have_gallery_images()) : ?>

	<div id="gallery" >
	  <ul>
			<?php foreach ( SubfolioFiles::gallery_images() as $image) : ?>
			
        <li>
          <a href="<?php echo $image['link']; ?>">
  					<div class="<?php echo $image['class'] ?>" style="width:<?php echo $image['container_width']."px"; ?>; height:<?php echo $image['container_height']."px"; ?>">
  						<img width="<?php echo $image['width']."px" ?>" height="<?php echo $image['height']."px" ?>" src="<?php echo $image['url'] ?>" />
  					</div>
  					<?php if (SubfolioTheme::get_option('display_file_names_in_gallery')) { ?>
          	  <p><?php echo $image['filename'] ?></p>
          	<?php } ?>
  				</a>
        </li>
			
			<?php endforeach; ?>
		</ul>
	</div><!-- gallery -->

<?php endif ?>