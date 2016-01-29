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
				<img width='<?php echo $image['width'] ?>' height='<?php echo $image['height'] ?>' src='<?php echo $image['url'] ?>' />
			<?php endforeach; ?>
			<div class="clear"><!-- --></div>
	</div><!-- inline top image -->
<?php endif ?>

<?php if (SubfolioFiles::have_inline_rss('top')) : ?>

	<?php foreach (SubfolioFiles::inline_rss('top') as $rss) : 
	  require("_inline_rss.php");
	endforeach; ?>

<?php endif ?>