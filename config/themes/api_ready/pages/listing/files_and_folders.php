<?php if (API_HaveFiles()) : ?>

	<div id="listing">
		
		<ul class="<?php echo API_ListingMode() ?>">
			
			// ****************************** HEADER ************************************
			<?php if (API_Option('display_file_listing_header')) { ?>
				<li class="listing-header">
					<span class="icon">
						<img src="<?php echo API_ViewUrl() ?>/images/system/no_icon.png" width='18' height='17' border='0' />
					</span>
					<span class="filename"><a href="?sort=filename"><?php echo API_Language('filebrowser.filename'); ?></a></span>
					<span class="size"><a href="?sort=size"><?php echo API_Language('filebrowser.size'); ?></a></span>
					<span class="date"><a href="?sort=date"><?php echo API_Language('filebrowser.date'); ?></a></span>
					<span class="kind"><a href="?sort=kind"><?php echo API_Language('filebrowser.kind'); ?></a></span>
					<span class="comment"><?php echo API_Language('filebrowser.comment'); ?></span>
				</li>
			<?php } ?>
			
			// ****************************** FILE LISTING ******************************
			<?php foreach ( API_FilesAndFolders() as $item) : ?>
				<li>
					<a target="<?php echo $item['target'] ?>" href="<?php echo $item['url'] ?>">
						<span class="icon"><img src='<?php echo $item['icon'] ?>' width='18' height='17' /></span>
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
	
	<p><?php API_Language('filebrowser.emptydirectory') ?></p>
	
<?php endif ?>