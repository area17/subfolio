<?php if ( SubfolioFiles::have_features() ) : ?>

	<div id="features">
	  <ul>
			<?php foreach ( SubfolioFiles::features() as $feature) : ?>
		    <li>
				  <a href="<?php echo $feature['link'] ?>">
			    	<img src="<?php echo $feature['image_file'] ?>">
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