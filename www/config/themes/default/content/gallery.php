<?php if (sizeof($files) > 0) { ?>
<div id="gallery">
  <ul class="gallery">
  <?php foreach ($files as $file) { ?>
    <li>
      <a href="<?php echo $this->filebrowser->get_link($file->name); ?>"><img src="<?php echo $file->get_thumbnail_url() ?>" /></a>
      <p><?php echo $file->name ?></p>
    </li>
  <?php } ?>
  </ul>
  <div class="clearfix"></div>
</div>
<?php } ?>
