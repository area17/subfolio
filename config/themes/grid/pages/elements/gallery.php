<?php 
$files   = $this->filebrowser->get_file_list("img");
if (sizeof($files) > 0) { 
  $this->filebrowser->set_displayed_content(true);
?>
<div id="gallery" >
  <ul class="gallery">
  <?php foreach ($files as $file) { 
    if ($file->needs_thumbnail()) { 
      $thumbnail = $file->get_thumbnail_url();
      if ($thumbnail <> '') {
      ?>
      <li>
        <a href="<?php echo $this->filebrowser->get_link($file->name); ?>"><img src="<?php echo $thumbnail ?>" /></a>
        <p><?php echo $file->name ?></p>
      </li>
      <?php } ?>
    <? } else { ?>
      <li>
        <a href="<?php echo $this->filebrowser->get_link($file->name); ?>"><img src="<?php echo $file->get_url() ?>" /></a>
        <p><?php echo $file->name ?></p>
      </li>
    <?php } ?>
    <?php } ?>
  <div class="clearfix"></div>
  </ul>
</div>
<?php } ?>
