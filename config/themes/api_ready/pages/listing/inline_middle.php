<?php if (API_HaveInlineImages('middle')) : ?>

	<div id="inline_middle_image" >
			<?php foreach ( API_InlineImages('middle') as $image) : ?>
				<img width='<?php echo $image['width'] ?>' height='<?php echo $image['height'] ?>' src='<?php echo $image['url'] ?>' />
			<?php endforeach; ?>
	</div><!-- gallery -->

<?php endif ?>


<?php if (API_HaveInlineTexts('middle')) : ?>

	<div id="inline_middle_text" class="standard_paragraph">
			<?php foreach ( API_InlineTexts('middle') as $text) : ?>
				<?php echo $text['body'] ?>
			<?php endforeach; ?>
	</div><!-- gallery -->

<?php endif ?>