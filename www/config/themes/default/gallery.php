<?php if (sizeof($files) > 0) { ?>
  <?php foreach ($files as $file) { ?>
    <div class="thumbnail spacing">
      <a href="<?php echo $this->filebrowser->get_link($file->name); ?>"><img src="<?php echo $file->get_thumbnail_url() ?>" /></a>
      <div class='thumbnail_name'><?php echo $file->name ?></div>
    </div>
  <?php } ?>
  <div class="clearfix"></div>
<?php } ?>
