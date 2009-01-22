<?php
class FileFolder {
  var $name;
  var $parent;

  // 'file' or 'folder'
  var $type;

  var $stats;

  var $comment;
  
  public function __construct($name, $parent, $type, $stats, $comment) {
    $this->name     = $name;
    $this->parent   = $parent;
    $this->type     = $type;
    $this->stats    = $stats;
    $this->comment  = $comment;
  }
  
  public function get_thumbnail_url() {
    $thumbnail = ".thumbnails/".$this->name;
    $url = "/directory/".$this->parent."/.thumbnails/".$this->name;

    if (!file_exists(".thumbnails")) mkdir(".thumbnails", 0755, true);

    $build_thumbnail = false;
    if (!file_exists($thumbnail)) {
      //$build_thumbnail = true;
    } else {
      // check age of thumbnail compared to the age of the source
    }

    if ($build_thumbnail) {
      $this->image = new Image($this->name);
      $this->image->resize(100, 100, Image::WIDTH);            
      $this->image->save($thumbnail);
    }
    
    return $url;
  }
  
}
?>