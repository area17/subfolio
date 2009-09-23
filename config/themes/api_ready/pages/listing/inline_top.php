<?php if (API_HaveInlineImages('top')) : ?>

	<div id="inline_top_image" >
			<?php foreach ( API_InlineImages('top') as $image) : ?>
				<img width='<?php echo $image['width'] ?>' height='<?php echo $image['height'] ?>' src='<?php echo $image['url'] ?>' />
			<?php endforeach; ?>
	</div><!-- gallery -->

<?php endif ?>


<?php if (API_HaveInlineTexts('top')) : ?>

	<div id="inline_top_text" class="standard_paragraph">
			<?php foreach ( API_InlineTexts('top') as $text) : ?>
				<?php echo $text['body'] ?>
			<?php endforeach; ?>
	</div><!-- gallery -->

<?php endif ?>