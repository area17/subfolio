<?php
class FileFolder {
  var $name;
  var $parent;

  // 'file' or 'folder'
  var $type;
  var $kind;
  var $stats;

  var $access = null;
  
  public function __construct($name, $parent, $type, $kind, $stats) {
    $this->name     = $name;
    $this->parent   = $parent;
    $this->type     = $type;
    $this->kind     = $kind;
    $this->stats    = $stats;
  }

  public function get_display_name() {
    $display = $this->fix_display_name($this->name);
    return $display;
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

  public function needs_thumbnail() {
    $needs = true;
    $thumbnail_width = Kohana::config('filebrowser.thumbnail_width');
    $thumbnail_height = Kohana::config('filebrowser.thumbnail_height');
    
		$info = @getimagesize($this->name);
    if ($info[0] <= $thumbnail_width && $info[1] <= $thumbnail_height) {
      $needs = false;
    }
    
    return $needs;
  }

  public function has_thumbnail() {
    $custom_thumbnail = "-custom-thumbnails/".$this->name;
    if (file_exists($custom_thumbnail)) {
      return true;
    } else {
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
    return false;
  }

  public function get_url() {
    $url = "/directory/".$this->parent."/".$this->name;
    return $url;
  }
  
  public function get_thumbnail_url() {
    $custom_thumbnail = "-custom-thumbnails/".$this->name;
    $url = "/directory/".$this->parent."/-custom-thumbnails/".$this->name;

    if (file_exists($custom_thumbnail)) {
      return $url;
    } else {
      $thumbnail = "-thumbnails/".$this->name;
      $url = "/directory/".$this->parent."/-thumbnails/".$this->name;
  
      if (!file_exists("-thumbnails")) mkdir("-thumbnails", 0755, true);
  
      $build_thumbnail = false;
      if (!$this->has_thumbnail()) {
        $build_thumbnail = true;
      }
  
      if ($build_thumbnail) {
        $thumbnail_width = Kohana::config('filebrowser.thumbnail_width');
        $thumbnail_height = Kohana::config('filebrowser.thumbnail_height');
        
        $this->image = new Image($this->name);
        $this->image->resize($thumbnail_width, $thumbnail_height, Image::HEIGHT);            
        $this->image->crop($thumbnail_width, $thumbnail_height, 'top', 'left');
        $this->image->save($thumbnail);
      }
      
      $thumbnail_stats = stat($thumbnail);
      return $url."?rnd=".$thumbnail_stats['mtime'];
    }
  }

  public static function fix_display_name($value='') {
    $display = $value;
    $display = str_replace("_", " ", $display);
    return $display;
  }

	// COMPARES TWO DATES
  public function listingDateCmpAsc($a, $b) {
    if ($a->stats['mtime'] == $b->stats['mtime']) {
     return 0;
    }
    return ($a->stats['mtime'] < $b->stats['mtime']) ? -1 : 1;
  }

	// COMPARES TWO SIZES
  public function listingSizeCmpAsc($a, $b) {
    if ($a->stats['size'] == $b->stats['size']) {
     return 0;
    }
    return ($a->stats['size'] < $b->stats['size']) ? -1 : 1;
  }

	// COMPARE TWO NAMES
  public function listingNameCmpAsc($a, $b) {
    return strcmp($a->name, $b->name);
  }

	// COMPARES TWO KIND
  public function listingKindCmpAsc($a, $b) {
    return strcmp($a->kind, $b->kind);
  }

	// COMPARES TWO DATES
  public static function listingDateCmpDesc($a, $b) {
    if ($a->stats['mtime'] == $b->stats['mtime']) {
     return 0;
    }
    return ($a->stats['mtime'] > $b->stats['mtime']) ? -1 : 1;
  }

	// COMPARES TWO SIZES
  public static function listingSizeCmpDesc($a, $b) {
    if ($a->stats['size'] == $b->stats['size']) {
     return 0;
    }
    return ($a->stats['size'] > $b->stats['size']) ? -1 : 1;
  }

	// COMPARE TWO NAMES
  public static function listingNameCmpDesc($a, $b) {
    return strcmp($b->name, $a->name);
  }

	// COMPARES TWO KIND
  public static function listingKindCmpDesc($a, $b) {
    return strcmp($b->kind, $a->kind);
  }  
}
?>