<?php 
$inline = $this->filebrowser->get_file_list("img", "-l", true);
if (sizeof($inline) > 0) { 
  foreach($inline as $file) {
  ?>
  <img src='/directory/<?php echo $this->filebrowser->get_folder()."/".$file->name ?>' />
<?php 
  }
} ?>

<?php if ($this->filebrowser->get_folder_property('text-top') <> '') { ?>
<div class="listing-top">
  <p><?php echo $this->filebrowser->get_folder_property('text-top'); ?></p>
</div>
<?php } ?>