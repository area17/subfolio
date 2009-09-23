<?php if ( API_HaveFeatures() ) : ?>

	<div id="features">
	  <ul>
			<?php foreach ( API_Features() as $feature) : ?>
		    <li>
				  <a href="<?php echo $feature['link'] ?>">
			    	<img src="<?php echo $feature['image_file'] ?>">
			      <div class="info">
			        <h2><?php echo $feature['title'] ?></h2>
			        <?php echo $feature['description'] ?>
			      </div>
				  </a>
		    </li>
			<?php endforeach; ?>
	  </ul>
	</div>

<?php endif; ?>