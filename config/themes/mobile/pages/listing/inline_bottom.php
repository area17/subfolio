<!-- Do we really need three different files for this || can we re-use the code? -->

<?php if (SubfolioFiles::have_inline_texts('bottom')) : ?>

	<div id="inline_bottom_text" class="standard_paragraph">
			<?php foreach ( SubfolioFiles::inline_texts('bottom') as $text) : ?>
				<?php echo $text['body'] ?>
			<?php endforeach; ?>
	</div><!-- gallery -->

<?php endif ?>

<?php if (SubfolioFiles::have_inline_images('bottom')) : ?>

	<div id="inline_bottom_image" >
			<?php foreach ( SubfolioFiles::inline_images('bottom') as $image) : ?>
				<img width='100%' height='auto' src='<?php echo $image['url'] ?>' />
			<?php endforeach; ?>
	</div><!-- gallery -->

<?php endif ?>


