<?php $features = $this->filebrowser->get_folder_property('features');
if (sizeof($features) > 0) { ?>
<div id="features">
  <ul>
  <?php foreach ($features as $feature) { ?>
    <li>
      <div class="image">
        <a href="<?php echo $feature['link'] ?>"><img src="/directory/<?php echo $this->filebrowser->get_folder() ?>/<?php echo $feature['image'] ?>"></a>
      </div>
      <div class="info">
        <a href="<?php echo $feature['link'] ?>"><h2><?php echo $feature['title'] ?></h2></a>
        <p><?php echo $feature['description'] ?></p>
      </div>
      <div class="clear"></div>
    </li>
  <?php } ?>
  </ul>
  <div class="clear"></div>
</div>
<?php } ?>