<?php 
// -------------------- INLINE TOP IMAGES (-t-*) -----------------------------------------------------------------------------
$inline = $this->filebrowser->get_file_list("img", "-b-", true);
if (sizeof($inline) > 0) { 
	$this->filebrowser->set_displayed_content(true);
	?> <div id="inline_bottom_image"> <?php
  foreach($inline as $file) {
  ?> <img src='/directory/<?php echo $this->filebrowser->get_folder()."/".$file->name ?>' /> <?php 
  }
	?> </div> <?php
} ?>

<?php
// -------------------- INLINE TOP TEXT (-t-*) --------------------------------------------------------------------------------
$inline = $this->filebrowser->get_file_list("txt", "-b-", true);
if (sizeof($inline) > 0) { 
  $this->filebrowser->set_displayed_content(true);
	?> <div id="inline_bottom_text" class="standard_paragraph"> <?php
  foreach($inline as $file) {
      echo format::get_rendered_text(file_get_contents($file->name));
  }
	?> </div> <?php
} ?>