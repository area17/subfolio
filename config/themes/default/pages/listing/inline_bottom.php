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
				<img width='<?php echo $image['width'] ?>' height='<?php echo $image['height'] ?>' src='<?php echo $image['url'] ?>' />
			<?php endforeach; ?>
	</div><!-- gallery -->

<?php endif ?>

<?php if (SubfolioFiles::have_inline_rss('bottom')) : ?>

	<?php foreach (SubfolioFiles::inline_rss('bottom') as $rss) :
	  require("_inline_rss.php");
	endforeach; ?>

<?php endif ?>