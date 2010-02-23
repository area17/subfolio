<?php if (SubfolioFiles::have_inline_texts('middle')) : ?>

	<div id="inline_middle_text" class="standard_paragraph">
			<?php foreach ( SubfolioFiles::inline_texts('middle') as $text) : ?>
				<?php echo $text['body'] ?>
			<?php endforeach; ?>
	</div><!-- gallery -->

<?php endif ?>

<?php if (SubfolioFiles::have_inline_images('middle')) : ?>

	<div id="inline_middle_image" >
			<?php foreach ( SubfolioFiles::inline_images('middle') as $image) : ?>
				<img width='100%' height='auto' src='<?php echo $image['url'] ?>' />
			<?php endforeach; ?>
	</div><!-- gallery -->

<?php endif ?>


