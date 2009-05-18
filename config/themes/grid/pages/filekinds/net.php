<?php
$url = $this->filebrowser->get_item_property($this->filebrowser->file, 'url')    ? $this->filebrowser->get_item_property($this->filebrowser->file, 'url') : '';
$target = $this->filebrowser->get_item_property($this->filebrowser->file, 'target')    ? $this->filebrowser->get_item_property($this->filebrowser->file, 'target') : '_blank';

if ($url <> '') { ?>
  Link: <a target="<?php echo $target ?>" href="<?php echo $url ?>"><?php echo $this->filebrowser->file ?></a>
<? } ?>