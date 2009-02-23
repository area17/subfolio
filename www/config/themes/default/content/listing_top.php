<?php 
$inline = $this->filebrowser->get_file_list("img", "-l", true);
$this->filebrowser->set_displayed_content(true);
if (sizeof($inline) > 0) { 
  foreach($inline as $file) {
  ?>
  <div id="inline-picture" class="clearfix">
    <img src='/directory/<?php echo $this->filebrowser->get_folder()."/".$file->name ?>' />
  </div>
<?php 
  }
} ?>

<?php if ($this->filebrowser->get_folder_property('text-top') <> '') { 
  $this->filebrowser->set_displayed_content(true);
?>
<div class="listing-top">
  <p><?php echo $this->filebrowser->get_folder_property('text-top'); ?></p>
</div>
<?php } ?>

<?php 
$inline = $this->filebrowser->get_file_list("txt", "-t-intro", true);
if (sizeof($inline) > 0) { 
  $this->filebrowser->set_displayed_content(true);
  foreach($inline as $file) {
    ?>
    <div id="listing-top" class="clearfix">
    <?php
      readfile($file->name);
    ?>
    </div>
    <?php
  }
} ?>


<?php 
$inline = $this->filebrowser->get_file_list("img", "-b", true);
if (sizeof($inline) > 0) { 
  $this->filebrowser->set_displayed_content(true);
  foreach($inline as $file) {
  ?>
  <img src='/directory/<?php echo $this->filebrowser->get_folder()."/".$file->name ?>' />
<?php 
  }
} ?>
