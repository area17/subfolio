<?php if (SubfolioFiles::have_related()) : ?>
	<div id="listing">
		<ul>
			<?php foreach ( SubfolioFiles::related() as $item) : ?>
				<li class="icon icon_cut">
					<a href="<?php echo $item['link'] ?>">
						<span class='arrow'></span>	
						<span class='filename'><?php echo $item['filename'] ?></span>
					</a>
				</li>
			<?php endforeach; ?>
		</ul>
	</div>
<?php endif; ?>