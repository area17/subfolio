<?php if (SubfolioFiles::have_gallery_images()) : ?>
	<div id="gallery" >
	  <ul>
			<?php foreach ( SubfolioFiles::gallery_images() as $image) : ?>
        <li>
          <a href="<?php echo $image['link']; ?>">
  					<div class="<?php echo $image['class'] ?>">
  						<img src="<?php echo $image['url'] ?>" />
  					</div>
  				</a>
        </li>
			<?php endforeach; ?>
		</ul>
	</div><!-- gallery -->
<?php endif ?>