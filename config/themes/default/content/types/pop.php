<?php
  $width    = $this->filebrowser->get_item_property($this->filebrowser->file, 'width')    ? $this->filebrowser->get_item_property($this->filebrowser->file, 'width') : 800;
  $height   = $this->filebrowser->get_item_property($this->filebrowser->file, 'height')   ? $this->filebrowser->get_item_property($this->filebrowser->file, 'height') : 600;
  $url      = $this->filebrowser->get_item_property($this->filebrowser->file, 'url')      ? $this->filebrowser->get_item_property($this->filebrowser->file, 'url') : 'http://www.subfolio.com';
  $name     = $this->filebrowser->get_item_property($this->filebrowser->file, 'name')     ? $this->filebrowser->get_item_property($this->filebrowser->file, 'name') : 'POPUP';
  $style    = $this->filebrowser->get_item_property($this->filebrowser->file, 'style')    ? $this->filebrowser->get_item_property($this->filebrowser->file, 'style') : 'POPSCROLL';

  $url = "javascript:pop('$url','$name',$width,$height,'$style');";
?>
Popup: <a href="<?php echo $url ?>"><?php echo $this->filebrowser->file ?></a>