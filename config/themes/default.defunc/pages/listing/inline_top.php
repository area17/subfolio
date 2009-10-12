<?php 
// -------------------- INLINE TOP IMAGES (-t-*) -----------------------------------------------------------------------------
$inline = $this->filebrowser->get_file_list("img", "-t-", true);
if (sizeof($inline) > 0) { 
	$this->filebrowser->set_displayed_content(true);
	?> <div id="inline_top_image"> <?php
  foreach($inline as $file) {
		list($width, $height, $type, $attr) = getimagesize($this->filebrowser->fullfolderpath."/".$file->name);
  ?> <img width='<?php echo $width ?>' height='<?php echo $height ?>' src='/directory/<?php echo $this->filebrowser->get_folder()."/".$file->name ?>' /> <?php 
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
      echo format::get_rendered_text(file_get_contents($file->name));
  }
	?> </div> <?php
} ?>