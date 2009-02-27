<?php
  $comment  = $this->filebrowser->get_item_property($this->filebrowser->file, 'comment')    ? $this->filebrowser->get_item_property($this->filebrowser->file, 'comment') : '';
?>
<p><a href="<?php echo $this->filebrowser->get_file_url(); ?>">Download <?php echo $this->filebrowser->file ?> (<?php echo format::filesize($file->stats['size'])  ?>)</a></p>
<p><?php echo $comment ?></p>