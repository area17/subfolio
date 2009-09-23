<?php if (API_HaveRelated()) : ?>
	
	<div id="related">
		<p><?php API_Language('filebrowser.seealso') ?></p>
		<ul class="<?php echo API_ListingMode() ?>">
			
			<?php foreach ( API_Related() as $item) : ?>
				<li>
					<a href='<?php echo $item['link'] ?>'>
						<span class="icon">
							<img src="<?php echo $item['url'] ?>" width="<?php $item['width'] ?>" height="<?php $item['height'] ?>" />
						</span>
						<span class="filename"><?php echo $item['filename'] ?></span>
					</a>
				</li>
			<?php endforeach; ?>
			
		</ul>
  </div>

<?php endif ?>