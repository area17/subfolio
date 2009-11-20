<?php if (SubfolioFiles::have_related()) : ?>
	
	<div id="related">
		<p><?php echo SubfolioLanguage::get_text('seealso') ?></p>
		<ul class="<?php echo SubfolioTheme::get_listing_mode() ?>">
			
			<?php foreach ( SubfolioFiles::related() as $item) : ?>
				<li>
					<a href='<?php echo $item['link'] ?>'>
						<?php if (SubfolioTheme::get_option('display_icons')) { ?>
							<span class="icon" <?php if (SubfolioTheme::get_mobile_viewport()) { echo "style='background-image:url(".$item['icon_grid'].")'"; } ?>>
								<img src="<?php echo $item['icon'] ?>" width="<?php $item['width'] ?>" height="<?php $item['height'] ?>" />
							</span>
						<?php } ?>
						<span class="filename"><?php echo $item['filename'] ?></span>
					</a>
				</li>
			<?php endforeach; ?>
			
		</ul>
  </div>

<?php endif ?>