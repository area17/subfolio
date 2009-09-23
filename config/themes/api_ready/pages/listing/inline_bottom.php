<!-- Do we really need three different files for this || can we re-use the code? -->

<?php if (API_HaveInlineImages('bottom')) : ?>

	<div id="inline_bottom_image" >
			<?php foreach ( API_InlineImages('bottom') as $image) : ?>
				<img width='<?php echo $image['width'] ?>' height='<?php echo $image['height'] ?>' src='<?php echo $image['url'] ?>' />
			<?php endforeach; ?>
	</div><!-- gallery -->

<?php endif ?>


<?php if (API_HaveInlineTexts('bottom')) : ?>

	<div id="inline_bottom_text" class="standard_paragraph">
			<?php foreach ( API_InlineTexts('bottom') as $text) : ?>
				<?php echo $text['body'] ?>
			<?php endforeach; ?>
	</div><!-- gallery -->

<?php endif ?>