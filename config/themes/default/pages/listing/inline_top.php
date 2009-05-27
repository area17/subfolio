<?php 
// -------------------- INLINE TOP IMAGES (-t-*) -----------------------------------------------------------------------------
$inline = $this->filebrowser->get_file_list("img", "-t-", true);
if (sizeof($inline) > 0) { 
	$this->filebrowser->set_displayed_content(true);
	?> <div id="inline_top_image"> <?php
  foreach($inline as $file) {
  ?> <img src='/directory/<?php echo $this->filebrowser->get_folder()."/".$file->name ?>' /> <?php 
  }
	?> </div> <?php
} ?>

<?php
// -------------------- INLINE TOP TEXT (-t-*) --------------------------------------------------------------------------------
$inline = $this->filebrowser->get_file_list("txt", "-t-", true);
if (sizeof($inline) > 0) { 
  $this->filebrowser->set_displayed_content(true);
	?> <div id="inline_top_text" class="standard_paragraph"> <?php
  foreach($inline as $file) {
      readfile($file->name);
  }
	?> </div> <?php
} ?>