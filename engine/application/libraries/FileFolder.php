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

  public function get_display_name($replace_dashes=true, $replace_underscores=true, $display_extension=true) {
    $display = $this->fix_display_name($this->name, $replace_dashes, $replace_underscores, $display_extension);
    return htmlentities($display);
  }

  protected function load_access() {
    if ($this->access == null) {
      $this->access = new Access();
      if ($this->parent <> '') {
        $folder = $this->parent . "/" . $this->name;
      } else {
        $folder = $this->name;
      }
      $this->access->load_access($folder, true);
    }
  }

  public function is_restricted() {
    $this->load_access();
    return $this->access->is_restricted();
  }

  public function contains_access_file() {
		$access_file = $this->name."/".Kohana::config('filebrowser.access_file');
  	if (!file_exists($access_file)) {
      $access_file = $this->name."/".Kohana::config('filebrowser.access_file').".txt";
    }

		return (file_exists($access_file));
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
    $thumbnail_width = SubfolioTheme::get_option('thumbnail_width', Kohana::config('filebrowser.thumbnail_width'));
    $thumbnail_height = SubfolioTheme::get_option('thumbnail_height', Kohana::config('filebrowser.thumbnail_height'));
		$info = @getimagesize($this->name);

    if ($info[1] <= $thumbnail_height) {
      $needs = false;
    }

    return $needs;
  }

  public function get_width() {
		$size = @getimagesize($this->name);
    return $size[0];
  }

  public function get_height() {
		$size = @getimagesize($this->name);
    return $size[1];
  }

  public function has_thumbnail($check_needs=false) {
    $custom_thumbnail = "-thumbnails-custom/".$this->name;
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

  public function get_gallery_width_height($value='')
  {
    $width = 320;
    $height = 240;

    $filename = null;
    if ($this->has_custom_thumbnail()) {
      $filename = "-thumbnails-custom/".$this->name;
    } else if ($this->has_thumbnail()) {
      $filename = "-thumbnails/".$this->name;
    } else {
      $filename = $this->name;
    }
    
		$size = @getimagesize($filename);
		$width = $size[0];
		$height= $size[1];
    
    return array($width, $height);
  }

  public function get_url() {
    $url = "/directory/".$this->parent."/".Filebrowser::double_encode_specialcharacters(urlencode($this->name));
    return $url;
  }
  
	public function has_custom_thumbnail() {
		$custom_thumbnail = "-thumbnails-custom/".$this->name;
		return (file_exists($custom_thumbnail));
	}

  public function get_thumbnail_url() {
    if ($this->has_custom_thumbnail()) {
      return "/directory/".format::urlencode_parts($this->parent)."/-thumbnails-custom/".Filebrowser::double_encode_specialcharacters(urlencode($this->name));
    } else {
      
      $thumbnail = "-thumbnails/".$this->name;
      $url = "/directory/".format::urlencode_parts($this->parent)."/-thumbnails/".Filebrowser::double_encode_specialcharacters(urlencode($this->name));
  
      if (!file_exists("-thumbnails")) mkdir("-thumbnails", 0755, true);
  
      $build_thumbnail = false;
      if (!$this->has_thumbnail()) {
        $build_thumbnail = true;
      }
  
      if ($build_thumbnail) {
        $max_size = Kohana::config('filebrowser.thumbnail_max_filesize');
        $stats = stat($this->name);
        if ($stats['size'] > ($max_size * 1024 * 1024)) {
          return '';
        } else {
          $thumbnail_width = SubfolioTheme::get_option('thumbnail_width', Kohana::config('filebrowser.thumbnail_width'));
          $thumbnail_height = SubfolioTheme::get_option('thumbnail_height', Kohana::config('filebrowser.thumbnail_height'));

      		$info = @getimagesize($this->name);
      		if (isset($info[1])) {
            if ($info[1] <= $thumbnail_height) {
            } else {
              $this->image = new Image($this->name);
              if ($this->image) {
                $this->image->resize($thumbnail_width, $thumbnail_height, Image::HEIGHT);            
                $this->image->save($thumbnail);
              }
            }
          }
        }
      }
      
      if (file_exists($thumbnail)) {
        $thumbnail_stats = stat($thumbnail);
        return $url."?rnd=".$thumbnail_stats['ctime'];
      } else {
        return '';
      }
    }
  }

  public static function fix_display_name($value='', $replace_dashes=true, $replace_underscores=true, $display_extension=true) {
    $display = $value;

    if ($replace_dashes) {
      $display = str_replace("-", " ", $display);
    }
    
    if ($replace_underscores) {
      $display = str_replace("_", " ", $display);
    }
    
    if (!$display_extension) {
      $path_parts = pathinfo($value);
      if (isset($path_parts['extension'])) {
        $display = substr($display, 0, (-1 * (1+strlen($path_parts['extension']))));
      }
    }
    
    return $display;
  }

  public static function make_title_display($value='', $replace_dashes=true, $replace_underscores=true, $display_extension=true) {
    $display = "";
    $list = array_reverse(explode("/", $value));
    $first = true;
    foreach ($list as $item) {
      if (!$first) {
        $display .= " / ";
      }

	    if (!$display_extension) {
	      $path_parts = pathinfo($item);
	      if (isset($path_parts['extension'])) {
	        $display .= substr($item, 0, (-1 * (1+strlen($path_parts['extension']))));
	      } else {
  	      $display .= $item;
	      }
	    } else {
	      $display .= $item;
	    }

      $first = false;
    }

    if ($replace_dashes) {
      $display = str_replace("-", " ", $display);
    }
    
    if ($replace_underscores) {
      $display = str_replace("_", " ", $display);
    }
    
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
    return strcmp(strtolower($a->name), strtolower($b->name));
  }

	// COMPARES TWO KIND
  public function listingKindCmpAsc($a, $b) {
    $a_kind = "";
    $b_kind = "";
    
    if ($a->kind) {
      if (is_string($a->kind)) {
        $kind = FileKind::instance()->get_kind_by_extension($a->kind);
        if ($kind && isset($kind['display'])) {
          $a_kind = $kind['display'];
        }
      } else if (is_array($a->kind)) {
        $a_kind = $a->kind['display'];
      }
    }

    if ($b->kind) {
      if (is_string($b->kind)) {
        $kind = FileKind::instance()->get_kind_by_extension($b->kind);
        if ($kind && isset($kind['display'])) {
          $b_kind = $kind['display'];
        }
      } else if (is_array($b->kind)) {
        $b_kind = $b->kind['display'];
      }
    }
    
    return strcmp(strtolower($a_kind), strtolower($b_kind));
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
    return strcmp(strtolower($b->name), strtolower($a->name));
  }

	// COMPARES TWO KIND
  public static function listingKindCmpDesc($a, $b) {
    $a_kind = "";
    $b_kind = "";

    if ($a->kind) {
      if (is_string($a->kind)) {
        $kind = FileKind::instance()->get_kind_by_extension($a->kind);
        if ($kind && isset($kind['display'])) {
          $a_kind = $kind['display'];
        }
      } else if (is_array($a->kind)) {
        $a_kind = $a->kind['display'];
      }
    }

    if ($b->kind) {
      if (is_string($b->kind)) {
        $kind = FileKind::instance()->get_kind_by_extension($b->kind);
        if ($kind && isset($kind['display'])) {
          $b_kind = $kind['display'];
        }
      } else if (is_array($b->kind)) {
        $b_kind = $b->kind['display'];
      }
    }
    
    return strcmp(strtolower($b_kind), strtolower($a_kind));
  }  
}
?>