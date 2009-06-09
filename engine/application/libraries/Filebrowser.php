<?php

/**
 *  Filebrowser
 */
class Filebrowser {
  var $config_name    = "filebrowser";

  var $path           = "";

  var $folder         = "";
  var $fullfolderpath = "";

  var $file           = "";
  var $filepath       = "";
  var $fullfilepath   = "";

  var $files          = array();

  var $properties     = array();

  var $updated_since  = "lastweek";

  var $sort_order           = "listingNameCmp";
  var $sort_order_direction = "Asc";

  var $displayed_content = false;

  var $filekind = null;

  public function __construct($config_name='filebrowser') {
    $this->config = Kohana::config($config_name);
    $this->config_name = $config_name;
    $this->filekind = FileKind::instance();

    $this->folder = $this->config['directory'];

    // check and update the updated_since settings
    $this->_updated_since();
    $this->_sort_order();
  }

  public function get_displayed_content() {
    return $this->displayed_content;
  }

  public function set_displayed_content($displayed) {
    $this->displayed_content = $displayed;
  }

  public function _sort_order() {
    $session= Session::instance();
    $sortFunction = "listingNameCmp";

    $currentSort = $session->get('sort_order');
    $currentSortOrder = $session->get('sort_order_direction');

    if (isset($_REQUEST["sort"])) {
      if ($_REQUEST["sort"] == "filename") {
        $sortFunction = "listingNameCmp";
      } else if ($_REQUEST["sort"] == "size") {
        $sortFunction = "listingSizeCmp";
      } else if ($_REQUEST["sort"] == "date") {
        $sortFunction = "listingDateCmp";
      } else if ($_REQUEST["sort"] == "kind") {
        $sortFunction = "listingKindCmp";
      }
      $session->set('sort_order', $sortFunction);
      $this->sort_order = $sortFunction;
      if ($currentSort == $sortFunction) {
        $newSortOrder = "Asc";
        if ($currentSortOrder == "Asc") {
          $newSortOrder = "Desc";
        }
        $session->set('sort_order_direction', $newSortOrder);
        $this->sort_order_direction = $newSortOrder;
      } else {
        $session->set('sort_order_direction', "Asc");
        $this->sort_order_direction = "Asc";
      }
    } else if ($currentSort != NULL) {
      $this->sort_order = $currentSort;
      $this->sort_order_order = $currentSortOrder;
    }
  }

  public function sort($list) {
    $func = "".$this->sort_order.$this->sort_order_direction;
		usort($list, array("FileFolder", $func));
		return $list;
  }

  private function _updated_since() {
    if (isset($_REQUEST["updated_since"])) {
        if ($_REQUEST["updated_since"] == "lastweek" || $_REQUEST["updated_since"] == "lastmonth" || $_REQUEST["updated_since"] == "lastvisit") {
          $this->updated_since = $_REQUEST["updated_since"];
          cookie::set("update_since", $this->updated_since, (3600 * 24 * 60));
        }
    } else {
      $val = cookie::get("update_since");
      if ($val != NULL) {
         $this->updated_since = $val;
      }
    }

    $session= Session::instance();

    if ($session->get('previous_visit') != NULL) {
        $value = date("Y-m-d h:i:s");
        cookie::set("last_visit", "".mktime(), 3600 * 24 * 60);
    } else {
        $last_visit = cookie::get("last_visit");
        if ($last_visit != NULL) {
          $session->set('previous_visit', $last_visit);
        } else {
          cookie::set("last_visit", "".mktime(), 3600 * 24 * 60);
          $session->set('previous_visit', "".mktime());
        }

    }
  }
  public function get_updated_since() {
    return $this->updated_since;
  }

  public function get_updated_since_time() {
    $time = strtotime("-7 days");
    if ($this->updated_since == "lastweek") {
    } else if ($this->updated_since == "lastmonth") {
      $time = strtotime("-1 month");
    } else if ($this->updated_since == "lastvisit") {
      $session= Session::instance();
      $time = $session->get('previous_visit', "".mktime());
    }

    return $time;
  }

	public static function instance($config_name='filebrowser') {
    static $instance;

    empty($instance) and $instance = new Filebrowser($config_name);
    return $instance;
	}

  public function get_path() {
    return $this->path;
  }

  public function set_path($path='') {
    $this->path = $path;
    $fullpath = $this->config['directory']."/".$path;

    if (is_dir($fullpath)) {
      $this->folder = $path;
      $this->fullfolderpath = $fullpath;

      $this->file = '';
      $this->fullfilepath = '';
    } else {
      $this->folder = dirname($path);
      $this->fullfolderpath = $this->config['directory']."/".dirname($path);

      $this->file         = basename($path);
      $this->filepath     = $path;
      $this->fullfilepath = $this->config['directory']."/".$path;
    }
    if (file_exists($this->fullfolderpath)) {
      chdir($this->fullfolderpath."/");
    }

    // load properties
    $properties_file = Kohana::config('filebrowser.properties_file');

    $array = Spyc::YAMLLoad($properties_file);
    $this->properties = $array;
  }

  public function exists() {
    if ($this->is_file()) return file_exists($this->fullfilepath);
    else return file_exists($this->fullfolderpath);
  }

  public function is_file() {
    if ($this->file == '') {
      return false;
    } else {
      return true;
    }
  }

  public function get_folder() {
    return $this->folder;
  }

  public function get_file() {
    if (file_exists($this->file)) {
      $stats = stat($this->file);
    } else  {
      $stats = array();
    }

    $fkind = $this->filekind->get_kind_by_file($this->file);
    $kind = isset($fkind['kind']) ? $fkind['kind'] : '';

    $ff = new FileFolder($this->file, $this->folder, 'file', $kind, $stats);
    return $ff;
  }

  public function prev_next_sort($list) {
    $gallery = array();
    $other = array();

    foreach ($list as $item) {
      if ($item->kind == 'Image') {
        $gallery[] = $item;
      } else {
        $other[] = $item;
      }
    }

    $newlist = array_merge($gallery, $other);
    return $newlist;
  }

  public function get_next($list, $name) {
    $max = sizeof($list);
    for($i=0; $i<$max; $i++) {
      $file = $list[$i];
      if ($file->name == $name) {
        if ($i < (sizeof($list)-1)) {
          return $list[++$i];
        }
      }
    }
    return null;
  }

  public function get_prev($list, $name) {
    $max = sizeof($list);
    for($i=0; $i<$max; $i++) {
      $file = $list[$i];
      if ($file->name == $name) {
        if ($i > 0) {
          return $list[--$i];
        }
      }
    }
    return null;
  }

  public function is_dir() {
    if ($this->file == '') {
      return true;
    } else {
      return false;
    }
  }

  public function get_parent_file_list($kind=null) {
    $files = array();
    
    $names = $this->sub_glob("*");
    if ($names) {
      foreach ($names as $filename) {
        if (!is_dir($filename)) {
          if (!$this->is_hidden($filename)) {
            $stats = stat($filename);
  
  
            $fkind = $this->filekind->get_kind_by_file($filename);
            $filekind = isset($fkind['kind']) ? $fkind['kind'] : '';
            $ff = new FileFolder($filename, $this->folder, 'file', $filekind, $stats);
  
            if ($kind != null) {
              if ($filekind === $kind) {
                $files[] = $ff;
              }
            } else {
              $files[] = $ff;
            }
          }
        }
      }
    }
    return $files;
  }



  public function get_file_list($kind=null, $prefix=null, $hidden=false){
    $files = array();

    $name = "*";
    if ($prefix != null) {
      $name = $prefix."*";
    }

    $names = $this->sub_glob($name);
    if ($names) {
      foreach ($names as $filename) {
        if (!is_dir($filename)) {
  
          if ($hidden || !$this->is_hidden($filename)) {
            $include = false;
  
            if ($kind != null) {
              $fkind = $this->filekind->get_kind_by_file($filename);
              $filekind = isset($fkind['kind']) ? $fkind['kind'] : '';
              if ($filekind === $kind) {
                $include = true;
              }
            } else {
              $include = true;
            }
  
            if ($include) {
              $stats = stat($filename);
              $fkind = $this->filekind->get_kind_by_file($filename);
              $filekind = isset($fkind['kind']) ? $fkind['kind'] : '';
              $ff = new FileFolder($filename, $this->folder, 'file', $filekind, $stats);
              $files[] = $ff;
            }
          }
        }
      }
    }

    return $files;
  }


  public function get_parent_folder_list($pattern='*'){
    $folders = array();

    $names = $this->sub_glob("../*");
    if ($names) {
      foreach ($names as $filename) {
        if (is_dir($filename)) {
          $filename = substr($filename, 3);
          if (!$this->is_hidden($filename)) {
            $ff = new FileFolder($filename, $this->folder, 'folder', "folder", array());
            $folders[] = $ff;
          }
        }
      }
    }
    return $folders;
  }

  public function get_folder_list($pattern='*'){
    $folders = array();
    $names = $this->sub_glob("*");
      if ($names) {
      foreach ($names as $filename) {
        if (is_dir($filename)) {
          if (!$this->is_hidden($filename)) {
            $stats = stat($filename);
            $fkind = $this->filekind->get_kind_by_file($filename);
            $ff = new FileFolder($filename, $this->folder, 'folder', $fkind, $stats);
            $folders[] = $ff;
          }
        }
      }
    }
    return $folders;
  }

  public function get_link($name) {
    if ($this->folder == "") {
      $link = "/".urlencode($name);
    } else {
      $link = "/".urlencode($this->folder)."/".urlencode($name);
      // unencode '/'
      $link = str_replace('%2F', '/', $link);
    }
    return $link;
  }

  public function get_file_url() {
    return "/directory/".$this->filepath;
  }

  public function is_feature($foldername) {
    $is_feature = false;
    $features = $this->get_folder_property('features');
    if (sizeof($features) > 0) {
      foreach ($features as $feature) {
        if (isset($feature['folder']) && $feature['folder'] == $foldername) {
          $is_feature = true;
          break;
        }
      }
    }

    // need to check all the fetaure files too
    if (!$is_feature) {
      $file_features = $this->get_file_list("ftr", null, true);
      if (sizeof($file_features) > 0) {
        foreach ($file_features as $file_feature) {
          $feature = Spyc::YAMLLoad($file_feature->name);
          if (isset($feature['folder']) && $feature['folder'] == $foldername) {
            $is_feature = true;
            break;
          }
        }
      }
    }

    return $is_feature;
  }

  public function get_folder_property($propertyname) {
    if (isset($this->properties[$propertyname])) {
      return $this->properties[$propertyname];
    }

    return null;
  }

  public function get_item_property($filename, $propertyname) {
    $property = null;
    $info_ext = Kohana::config('filebrowser.info_extension');
    if ($info_ext == "") {
      $info_ext = ".info";
    }

    // load properties file if it exists (not hidden)
    $info_filename = $filename.$info_ext;
    if (file_exists($info_filename)) {
      $array = Spyc::YAMLLoad($info_filename);
      if (isset($array[$propertyname])) {
        $property = $array[$propertyname];
      }
    }

    // load properties file if it exists (hidden)
    $info_filename = "-".$filename.$info_ext;
    if (file_exists($info_filename)) {
      $array = Spyc::YAMLLoad($info_filename);
      if (isset($array[$propertyname])) {
        $property = $array[$propertyname];
      }
    }

    if ($property == null) {
      if (isset($this->properties[$filename])) {
        $info = $this->properties[$filename];
        if (isset($info[$propertyname])) {
          $property = $info[$propertyname];
        }
      }
    }

    if ($property == null) {
      $fkind = $this->filekind->get_kind_by_file($filename);
      $kind = isset($fkind['kind']) ? $fkind['kind'] : '';
      if ($kind == "cut" || $kind == "pop" || $kind == "net" || $kind == "link") {
        $array = Spyc::YAMLLoad($filename);
        if (isset($array[$propertyname])) {
          $property = $array[$propertyname];
        }
      }
    }

    return $property;
  }

  public function create_archive($recursive) {
    $archive = new Archive('zip');
		$this->add_to_archive($archive, "../".basename($this->folder)."", $recursive);
    return $archive;
  }

  private function add_to_archive($archive, $folder, $recursive) {

    $names = $this->sub_glob($folder."*");
    if ($names) {
      foreach ($names as $filename) {
        if (is_dir($filename)) {
          if ($recursive) {
            $this->add_to_archive($archive, $filename."/", $recursive);
          }
        } else {
          $archive->add($filename, str_replace("../", "", $filename));
        }
      }
    }
  }

  function __get_kind($file) {
    $path_parts = pathinfo($file);

    $extension ="";
    if (isset($path_parts['extension'])) {
      $extension = $path_parts['extension'];
    } else {
    }

  	// get the extention
    $extension = strtolower($extension);
    $kind = "folder";

    if ($extension <> "") {
      switch ($extension) {
        case '':
          $kind = 'gen';
        break;

        case 'dir':
          $kind = 'dir';
        break;

        case 'png':
        case 'gif':
        case 'jpg':
          $kind = 'img';
        break;

        case 'ai':
        case 'eps':
          $kind = 'ai';
        break;

        case 'indd':
        $kind = 'indd';
        break;

        case 'psd':
        case 'tif':
        case 'tiff':
          $kind = 'psd';
        break;

        case 'bmp':
          $kind = 'gen';
        break;

        case 'lnk':
        case 'fr':
        case 'biz':
        case 'com':
        case 'net':
        case 'org':
        case 'html':
          $kind = 'net';
        break;

        case 'pop':
          $kind = 'pop';
        break;

        case 'xml':
        case 'txt':
        case 'php':
          $kind = 'txt';
        break;

        case 'swf':
          $kind = 'swf';
        break;

        case 'fla':
          $kind = 'fla';
        break;

        case 'cut':
          $kind = 'cut';
        break;

        case 'dcr':
          $kind = 'dcr';
        break;

        case 'mel':
          $kind = 'mel';
        break;

        case 'merlin2':
          $kind = 'merlin';
        break;

        case 'sit':
        case 'tar':
        case 'zip':
        case 'dmg':
        case 'gz':
          $kind = 'zip';
        break;

        case 'suit':
          $kind = 'fnt';
        break;

        case 'avi':
        case 'mov':
        case 'mpg':
        case 'mpeg':
        case 'mp4':
          $kind = 'vid';
        break;

        case 'mp3':
        case 'wav':
          $kind = 'snd';
        break;

        case 'php':
          $kind = 'php';
        break;

        case 'pdf':
          $kind = 'pdf';
        break;

        case 'doc':
        case 'rtf':
        case 'sql':
        case 'docx':
          $kind = 'doc';
        break;

        case 'ppt':
        case 'pptx':
        case 'pps':
          $kind = 'ppt';
        break;

        case 'xls':
        case 'xlsx':
          $kind = 'xls';
        break;

        case 'csv':
          $kind = 'csv';
        break;

        case 'site':
          $kind = 'site';
        break;

        case 'mail':
          $kind = 'mail';
        break;

        case 'pages':
          $kind = 'pages';
        break;

        case 'numbers':
          $kind = 'numbers';
        break;

        case 'key':
          $kind = 'key';
        break;

        case 'ftr':
          $kind = 'ftr';
        break;

        default:
          $kind = "unknown";
      }
    }
    return $kind;
  }

  function __get_kind_display($file) {
    $kind = $this->get_kind($file);
    if ($kind<> "") {
      switch ($kind) {
        case 'gen':
          $display = '';
        break;

        case 'dir':
          $display = 'Folder';
        break;

        case 'doc':
          $display = 'Word Document';
        break;

        case 'pages':
          $display = 'Pages Document';
        break;

        case 'numbers':
          $display = 'Numbers Document';
        break;

        case 'key':
          $display = 'Keynote Document';
        break;

        case 'ppt':
          $display = 'Powerpoint Document';
        break;

        case 'xls':
          $display = 'Excel Document';
        break;

        case 'csv':
          $display = 'Comma Seperated File';
        break;

        case 'img':
          $display = 'Image';
        break;

        case 'ai':
          $display = 'Illustrator File';
        break;

        case 'indd':
          $display = 'InDesign Document';
        break;

        case 'psd':
          $display = 'Photoshop File';
        break;

        case 'cut':
          $display = 'Shortcut';
        break;

        case 'net':
          $display = 'Internet Location';
        break;

        case 'pop':
          $display = 'Popup Window';
        break;

        case 'txt':
          $display = 'Text';
        break;

        case 'snd':
          $display = 'Audio File';
        break;

        case 'vid':
          $display = 'Movie';
        break;

        case 'swf':
          $display = 'Flash Movie';
        break;

        case 'fla':
          $display = 'Flash Movie';
        break;

        case 'ftr':
          $display = 'Feature';
        break;

        case 'zip':
        case 'dmg':
        case 'sit':
          $display = 'Archive';
        break;

        case 'php':
          $display = 'Script';
        break;

        case 'dcr':
          $display = 'Shockwave Movie';
        break;

        case 'pdf':
          $display = 'PDF Document';
        break;

        case 'fnt':
          $display = 'Font Suitcase';
        break;

        case 'site':
          $display = 'Mini Site';
        break;

        case 'mail':
          $display = 'Contact Form';
        break;

        default:
          $display = ucfirst($kind);
      }
    }
    return $display;
  }

  private function is_hidden($filename) {
    $hidden = false;
    $pos = strpos($filename, '-');
    if ($pos === false) {
      $hidden = false;
    } else {
      if ($pos == 0) {
        $hidden = true;
      }
    }

    if (!$hidden) {
      $pos = strpos($filename, '.');
      if ($pos === false) {
        $hidden = false;
      } else {
        if ($pos == 0) {
          $hidden = true;
        }
      }
    }

    if (!$hidden) {
      $pos = strpos($filename, '.');
      if ($pos === false) {
        $hidden = false;
      } else {
        if ($pos == 0) {
          $hidden = true;
        }
      }
    }

    if (!$hidden) {
      $info_ext = Kohana::config('filebrowser.info_extension') ?  Kohana::config('filebrowser.info_extension') : ".info" ;
      $ftr_ext = Kohana::config('filebrowser.feature_extension') ?  Kohana::config('filebrowser.feature_extension') : ".ftr" ;

      if (substr($filename, (-1 * strlen($info_ext))) == $info_ext) {
        $hidden = true;
      } else if (substr($filename, (-1 * strlen($ftr_ext))) == $ftr_ext) {
        $hidden = true;
      }
    }

    return $hidden;
  }
  
  public function sub_glob($pattern, $flags=NULL)
  {
    $split=explode('/',$pattern);
    $match=array_pop($split);
    $path=implode('/',$split);

    if ($path == "") $path = ".";
    if (($dir=opendir($path))!==false) {
      $glob=array();
      while(($file=readdir($dir))!==false) {
        if ($file != '.' && $file != '..') {
          if ($this->sub_fnmatch($match,$file)) {
            if ((is_dir("$path/$file"))||(!($flags&GLOB_ONLYDIR))) {
              if ($flags&GLOB_MARK) $file.='/';
              if ($path != ".") {
              	$glob[]=$path."/".$file;
            	} else {
              	$glob[]=$file;
            	}
            }
          }
        }
      }
      closedir($dir);
      if (!($flags&GLOB_NOSORT)) sort($glob);
      return $glob;
    } else {
        return false;
    }   
  }

  function sub_fnmatch($pattern, $string) {
    return preg_match("#^".strtr(preg_quote($pattern, '#'), array('\*' => '.*', '\?' => '.'))."$#i", $string);
  } 

}

?>
