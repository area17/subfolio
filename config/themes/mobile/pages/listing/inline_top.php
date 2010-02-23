<?php if (SubfolioFiles::have_inline_texts('top')) : ?>
	<div id="inline_top_text" class="standard_paragraph">
			<?php foreach (SubfolioFiles::inline_texts('top') as $text) : ?>
				<?php echo $text['body'] ?>
			<?php endforeach; ?>
	</div><!-- inline top text -->
<?php endif ?>

<?php if (SubfolioFiles::have_inline_images('top')) : ?>
	<div id="inline_top_image" >
			<?php foreach (SubfolioFiles::inline_images('top') as $image) : ?>
				<img width='100%' height='auto' src='<?php echo $image['url'] ?>' />
			<?php endforeach; ?>
	</div><!-- inline top image -->
<?php endif ?>

