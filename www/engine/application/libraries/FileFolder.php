<?php
class FileFolder {
  var $name;
  var $parent;

  // 'file' or 'folder'
  var $type;

  var $stats;

  var $comment;

  var $access = null;
  
  public function __construct($name, $parent, $type, $stats, $comment) {
    $this->name     = $name;
    $this->parent   = $parent;
    $this->type     = $type;
    $this->stats    = $stats;
    $this->comment  = $comment;
  }

  protected function load_access() {
    if ($this->access == null) {
      $this->access = new Access();
      $this->access->load_access($this->name);
    }
  }

  public function is_restricted() {
    $this->load_access();
    return $this->access->is_restricted();
  }

  public function have_access($user) {
    $have_access = false;
    
    $this->load_access();
    if ($this->access->check_access($user)) {
      $have_access = true;
    }        
    
    return $have_access;
  }

  public function has_thumbnail() {
    $thumbnail = ".thumbnails/".$this->name;
    if (file_exists($thumbnail)) {
      return true;
    } else {
      return false;
    }
  }
  
  public function get_thumbnail_url() {
    $thumbnail = ".thumbnails/".$this->name;
    $url = "/directory/".$this->parent."/.thumbnails/".$this->name;

    if (!file_exists(".thumbnails")) mkdir(".thumbnails", 0755, true);

    $build_thumbnail = false;
    if (!file_exists($thumbnail)) {
      $build_thumbnail = true;
    } else {
      // check age of thumbnail compared to the age of the source
    }

    if ($build_thumbnail) {
      $this->image = new Image($this->name);
      $this->image->resize(320, 240, Image::WIDTH);            
      $this->image->crop(320, 240);
      $this->image->save($thumbnail);
    }
    
    return $url;
  }
  
}
?>