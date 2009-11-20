<?php if ( SubfolioFiles::have_features() ) : ?>

	<div id="features">
	  <ul>
			<?php foreach ( SubfolioFiles::features() as $feature) : ?>
		    <li>
				  <a href="<?php echo $feature['link'] ?>" style="width: <?php echo $feature['image_width'] ?>px">
			    	<img src="<?php echo $feature['image_file'] ?>" width="<?php echo $feature['image_width'] ?>px" height="<?php echo $feature['image_height'] ?>px">
			      <div class="info">
			        <h2><?php echo $feature['title'] ?></h2>
			        <p><?php echo $feature['description'] ?></p>
			      </div>
				  </a>
		    </li>
			<?php endforeach; ?>
	  </ul>
	</div>

<?php endif; ?>