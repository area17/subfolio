<?php if (SubfolioFiles::have_related()) : ?>
	
	<div id="related">
		<p><?php echo SubfolioLanguage::get_text('seealso') ?></p>
		<ul class="<?php echo SubfolioTheme::get_listing_mode() ?>">
			
			<?php foreach ( SubfolioFiles::related() as $item) : ?>
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