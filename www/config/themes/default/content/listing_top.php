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
