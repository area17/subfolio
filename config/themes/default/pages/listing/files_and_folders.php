<?php if (SubfolioFiles::have_files()) : ?>

	<div id="listing">
		
		<ul class="<?php echo SubfolioTheme::get_listing_mode() ?>">
			
			<?php if (!SubfolioTheme::get_mobile_viewport() && SubfolioTheme::get_option('display_file_listing_header')) { ?>
				<li class="listing-header">
					<span class="icon">
						<img src="<?php echo SubfolioTheme::get_view_url() ?>/images/system/no_icon.png" width='18' height='17' border='0' />
					</span>
					<span class="filename"><a href="?sort=filename"><?php echo SubfolioLanguage::get_text('filename'); ?></a></span>
					<span class="size"><a href="?sort=size"><?php echo SubfolioLanguage::get_text('size'); ?></a></span>
					<span class="date"><a href="?sort=date"><?php echo SubfolioLanguage::get_text('date'); ?></a></span>
					<span class="kind"><a href="?sort=kind"><?php echo SubfolioLanguage::get_text('kind'); ?></a></span>
					<span class="comment"><?php echo SubfolioLanguage::get_text('comment'); ?></span>
				</li>
			<?php } ?>
			
			<?php foreach ( SubfolioFiles::files() as $item) : ?>
				<li>
					<a target="<?php echo $item['target'] ?>" href="<?php echo $item['url'] ?>">
						<?php if ($item['updated']) { ?>
  			      		<span class="updated"><!-- --></span>
  					<?php } ?>
  					<?php if ($item['new']) { ?>
  			      	<span class="new"><!-- --></span>
  					<?php } ?>
  					<?php if ($item['restricted']) { ?>
  						<span class="<?php if ($item['have_access']) { echo "unlocked"; } else { echo "locked"; } ?>"><!-- --></span>
  					<?php	} ?>
						<span class="icon" <?php if (SubfolioTheme::get_mobile_viewport()) { echo "style='background-image:url(".$item['icon_grid'].")'"; } ?>>
						<?php if (SubfolioTheme::get_listing_mode()=='list') : ?>
							<img src='<?php echo $item['icon'] ?>' width='18' height='17' />
						<?php else : ?>
							<img src='<?php echo $item['icon'] ?>' width='32' height='32' />
						<?php endif; ?>
						</span>
						<span class="filename"><?php echo $item['filename'] ?></span>
						<span class="size"><?php echo $item['size'] ?></span>
						<span class="date"><?php echo $item['date'] ?></span>
						<span class="kind"><?php echo $item['kind'] ?></span>
						<span class="comment"><?php echo $item['comment'] ?></span>
					</a>
				</li>
			<?php endforeach; ?>
			
		</ul>
		
	</div><!-- listing -->

<?php else : ?>
  <?php if (SubfolioFiles::is_empty_folder()) : ?>
  	<p><?php echo SubfolioLanguage::get_text('emptyfolder') ?></p>
  <?php endif; ?>	

<?php endif; ?>
