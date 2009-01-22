<p>GALLERY</p>

<?php foreach ($files as $file) { ?>
  <img src="<?php echo $file->get_thumbnail_url() ?>" />
<?php } ?>