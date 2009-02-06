<?php
class FileFolder {
  var $name;
  var $parent;

  // 'file' or 'folder'
  var $type;

  var $stats;

  var $access = null;
  
  public function __construct($name, $parent, $type, $stats) {
    $this->name     = $name;
    $this->parent   = $parent;
    $this->type     = $type;
    $this->stats    = $stats;
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
    $thumbnail = "-thumbnails/".$this->name;
    if (file_exists($thumbnail)) {
      // check the age of the thumbnail, if it was generated before the file modified, return false;
     $thumbnail_stats = stat($thumbnail);
     if ($thumbnail_stats['mtime'] > $this->stats['mtime']) {
       return true;
     } else {
       return false;
     }
    } else {
      return false;
    }
  }
  
  public function get_thumbnail_url() {
    $thumbnail = "-thumbnails/".$this->name;
    $url = "/directory/".$this->parent."/-thumbnails/".$this->name;

    if (!file_exists("-thumbnails")) mkdir("-thumbnails", 0755, true);

    $build_thumbnail = false;
    if (!$this->has_thumbnail()) {
      $build_thumbnail = true;
    }

    if ($build_thumbnail) {
      $this->image = new Image($this->name);
      $this->image->resize(320, 240, Image::HEIGHT);            
      $this->image->crop(320, 240, 'top', 'left');
      $this->image->save($thumbnail);
    }
    
    $thumbnail_stats = stat($thumbnail);
    return $url."?rnd=".$thumbnail_stats['mtime'];
  }
  
}
?>