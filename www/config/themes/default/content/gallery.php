<?php if (sizeof($files) > 0) { 
  $this->filebrowser->set_displayed_content(true);
?>
<div id="gallery">
  <ul class="gallery">
  <?php foreach ($files as $file) { 
    if ($file->needs_thumbnail()) { ?>
    <li>
      <a href="<?php echo $this->filebrowser->get_link($file->name); ?>"><img src="<?php echo $file->get_thumbnail_url() ?>" /></a>
      <p><?php echo $file->name ?></p>
    </li>
    <? } else { ?>
    <li>
      <img src="<?php echo $file->get_url() ?>" />
    </li>
    <?php } ?>
  <?php } ?>
  </ul>
  <div class="clearfix"></div>
</div>
<?php } ?>
