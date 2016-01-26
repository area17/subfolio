<?php if ( SubfolioFiles::have_features() ) : ?>

	<div id="features">
	  <ul>
			<?php foreach ( SubfolioFiles::features() as $feature) : 
				$style = 'style="';
				if (isset($feature['width'])) {
					$style .= ' width: '.$feature['width'] .'px; ';
				}
				if (isset($feature['height'])) {
					$style .= ' height: '.$feature['height'] .'px; ';
				}
				$style .= '"';

				$target = "";
				if (isset($feature['target']) && $feature['target'] !== NULL) {
					$target = 'target="'.$feature['target'].'"';
				}
				?>
		    <li>
				  <a <?php echo $target ?> href="<?php echo $feature['link'] ?>" <?php echo $style ?>>
				    <?php if (isset($feature['image_file'])) { ?>
			    	<img src="<?php echo $feature['image_file'] ?>" width="<?php echo $feature['image_width'] ?>" height="<?php echo $feature['image_height'] ?>">
			    	<?php } ?>
						<?php if (($feature['title'] <> '') || ($feature['description'] <> '')) { ?>
			      <div class="info">
			        <?php if ($feature['title'] <> '') { ?><h2><?php echo $feature['title'] ?></h2><?php } ?>
			        <?php if ($feature['description'] <> '') { ?><p><?php echo $feature['description'] ?></p><?php } ?>
			      </div>
			      <?php } ?>
				  </a>
		    </li>
			<?php endforeach; ?>
	  </ul>
	</div>

<?php endif; ?>