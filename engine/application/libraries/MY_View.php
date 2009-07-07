<?php
/**
 *
 * Based on code found on Kohana Forums
 *
 */
class View extends View_Core {
  protected static $options = null;  
  
  public function set_filename($name, $type = NULL) {    
    $theme = Kohana::config('filebrowser.theme');
    if (Kohana::find_file('views/../../../config/themes/'.$theme.'/', $name))
      parent::set_filename('../../../config/themes/'.$theme.'/'.$name, $type);
    elseif (Kohana::find_file('views/../../../config/themes/default/', $name))
      parent::set_filename('../../../config/themes/default/'.$name, $type);
    else
      parent::set_filename('../../../config/themes/'.$theme.'/'.$name, $type);
    return $this;
  }

  public static function view_exists($name) {
    $theme = Kohana::config('filebrowser.theme');
    
    if (Kohana::find_file('views/../../../config/themes/'.$theme.'/', $name)) {      
      return true;
    } elseif (Kohana::find_file('views/../../../config/themes/default/', $name)) {
      return true;
    } else {      
      return false;
    }
  }

  public function get_view_url() {
    $theme = Kohana::config('filebrowser.theme');
    return "/config/themes/".$theme;
  }
  
  public static function get_option($name, $default=null)
  {
    self::load_options();
    if (self::$options != null) {
      if (isset(self::$options[$name])) {
        return self::$options[$name];
      }
    }
    return $default;
  }

  public static function load_options()
  {
    if (self::$options == null) {
      $theme = Kohana::config('filebrowser.theme');
      $options_file = Kohana::find_file('views/../../../config/themes/'.$theme.'/', 'options', false, 'yml');
      if ($options_file) {
			  $array = Spyc::YAMLLoad($options_file);
			  self::$options = $array;
      } else {
        self::$options = array();
      }
    }
  }
}