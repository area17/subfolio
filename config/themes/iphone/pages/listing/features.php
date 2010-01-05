<?php if ( SubfolioFiles::have_features() ) : ?>

	<div id="listing" class="features">
		<ul>
			<?php foreach ( SubfolioFiles::features() as $feature) : ?>
				<?php
					// Center the image in a 99x99 crop
					$ratio = $feature['image_width'] / $feature['image_height'];
					$offset_y = ((99 * $ratio) - 99) / 2;
				?>
				<li>
					<a href='<?php echo $feature['link'] ?>'>
						<div class="crop">
							<img src="<?php echo $feature['image_file'] ?>" alt="" style='left:<?php echo -$offset_y ?>px' />
						</div>
						<span class='filename'><?php echo $feature['title'] ?></span>
						<span class='comment'><?php echo $feature['description'] ?></span>
					</a>
				</li>
			<?php endforeach; ?>
		</ul>
	</div>

<?php endif; ?>