<?php 
$file_features = $this->filebrowser->get_file_list("ftr", null, true);
$prop_features = $this->filebrowser->get_folder_property('features');

if (sizeof($file_features) > 0 || sizeof($prop_features) > 0) { ?>
<div id="features">
  <ul>
  <?php 
  if (sizeof($file_features) > 0) {
    foreach ($file_features as $file_feature) { 
    $feature = Spyc::YAMLLoad($file_feature->name);
    $feature_link = "";
    if (isset($feature['link'])) {
      $feature_link = $feature['link'];
    } else if (isset($feature['folder'])) {
      $feature_link = "/".$this->filebrowser->get_folder()."/".$feature['folder'];
    }
    ?>
    <li>
	  <a href="<?php echo $feature_link ?>">
      <div class="image">
        <img src="/directory/<?php echo $this->filebrowser->get_folder() ?>/<?php echo $feature['image'] ?>">
      </div>
      <div class="info">
        <h2><?php echo $feature['title'] ?></h2>
        <p><?php echo $feature['description'] ?></p>
      </div>
	  </a>
      
    </li>
  <?php } 
  } ?>

  <?php if (sizeof($prop_features) > 0) {
  foreach ($prop_features as $feature) { 
    $feature_link = "";
    if (isset($feature['link'])) {
      $feature_link = $feature['link'];
    } else if (isset($feature['folder'])) {
      $feature_link = "/".$this->filebrowser->get_folder()."/".$feature['folder'];
    }
  ?>
    <li>
	  <a href="<?php echo $feature_link ?>">
      <div class="image">
        <img src="/directory/<?php echo $this->filebrowser->get_folder() ?>/<?php echo $feature['image'] ?>">
      </div>
      <div class="info">
        <h2><?php echo $feature['title'] ?></h2>
        <p><?php echo $feature['description'] ?></p>
      </div>
	  </a>
      
    </li>

  <?php } 
  } ?>
  </ul>

</div>
<?php } ?>
