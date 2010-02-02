<?php if (SubfolioFiles::have_files()) : ?>
	<div id="listing">
		<ul>
			<?php foreach ( SubfolioFiles::files() as $item) : ?>
				<li class="icon icon_<?php echo $item['icon_name'] ?>">
					<a target="<?php echo $item['target'] ?>" href="<?php echo $item['url'] ?>">
						<?php if ($item['restricted']) { ?>
  						<span class="<?php if ($item['have_access']) { echo "unlocked"; } else { echo "locked"; } ?>"><!-- --></span>
  					<?php	} ?>
						<span class='arrow'></span>	
						<span class='filename'><?php echo $item['filename'] ?></span>
					</a>
				</li>
			<?php endforeach; ?>
		</ul>
	</div>
<?php endif; ?>