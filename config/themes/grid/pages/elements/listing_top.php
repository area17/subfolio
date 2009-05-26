<?php 
// -------------------- INLINE TOP IMAGES (-l-*) -----------------------------------------------------------------------------
$inline = $this->filebrowser->get_file_list("img", "-l", true);
if (sizeof($inline) > 0) { 
	$this->filebrowser->set_displayed_content(true);
  foreach($inline as $file) {
  ?>
  <div id="inline-picture">
    <img src='/directory/<?php echo $this->filebrowser->get_folder()."/".$file->name ?>' />
  </div>
<?php 
  }
} ?>

<?php
	// -------------------- PROPERTIES TOP TEXT --------------------------------------------------------------------------------
	if ($this->filebrowser->get_folder_property('text-top') <> '') { 
  $this->filebrowser->set_displayed_content(true);
	?>
	<div id="top-text" class="standard_paragraph">
	  <p><?php echo $this->filebrowser->get_folder_property('text-top'); ?></p>
	</div>
<?php } ?>

<?php
// -------------------- INLINE TOP TEXT (-t-*) --------------------------------------------------------------------------------
$inline = $this->filebrowser->get_file_list("txt", "-t-top", true);
if (sizeof($inline) > 0) { 
  $this->filebrowser->set_displayed_content(true);
  foreach($inline as $file) {
    ?>
    <div id="top-text" class="standard_paragraph">
    <?php
      readfile($file->name);
    ?>
    </div>
    <?php
  }
} ?>

<?php 
// -------------------- INLINE BOTTOM IMAGES? (-b-*) -----------------------------------------------------------------------------
$inline = $this->filebrowser->get_file_list("img", "-b", true);
if (sizeof($inline) > 0) { 
  $this->filebrowser->set_displayed_content(true);
  foreach($inline as $file) {
  ?>
  <img src='/directory/<?php echo $this->filebrowser->get_folder()."/".$file->name ?>' />
<?php 
  }
} ?>
