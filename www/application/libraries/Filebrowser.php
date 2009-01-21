<?php

/**
 *  Filebrowser
 */
class Filebrowser {
  var $config_name = "auth";

  var $folder = "";
  var $fullfolderpath = "";
  
  var $file         = "";
  var $filepath     = "";
  var $fullfilepath = "";

  public function __construct($config_name='filebrowser') {
    $this->config = Kohana::config($config_name);
    $this->config_name = $config_name;
    
    $this->folder = $this->config['directory'];
    $this->path = '';
  }


	public static function instance($config_name='filebrowser') {
    static $instance;
    // Load the Authlite instance
    empty($instance) and $instance = new Filebrowser($config_name);
    return $instance;
	}

  public function set_path($path='') {
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
    chdir($this->fullfolderpath);
  }  

  public function is_file() {
    if ($this->file == '') {
      return false;
    } else {
      return true;
    }
  }

  public function is_dir() {
    if ($this->file == '') {
      return true;
    } else {
      return false;
    }
  }

  public function get_file_list($pattern='*'){
    $files = array();
    foreach (glob("*") as $filename) {
      if (!is_dir($filename)) {
        $files[] = $filename;
      }
    }
    return $files;
  }

  public function get_folder_list($pattern='*'){
    $folders = array();
    foreach (glob("*") as $filename) {
      if (is_dir($filename)) {
        $folders[] = $filename;
      }
    }
    return $folders;
  }

  public function get_link($name) {
    return "".$this->folder."/".$name;
  }

  public function get_file_url() {
    return "/directory/".$this->filepath;
  }

}


?>