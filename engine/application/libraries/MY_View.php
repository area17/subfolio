<?php
/**
 *
 * Based on code found on Kohana Forums
 *
 */
class View extends View_Core {
  protected static $options = null;  
  protected static $colors  = null;  
  
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
    $root = SubfolioTheme::get_site_root();
    $theme = Kohana::config('filebrowser.theme');
    return $root."config/themes/".$theme;
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

  public function get_color($name, $default=null)
  {
    self::load_options();
    if (self::$colors != null) {
      if (isset(self::$colors[$name])) {
        return self::$colors[$name];
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

        if (isset($array['color_palette'])) {       
          $colors_file = Kohana::find_file('views/../../../config/themes/'.$theme.'/colors/', $array['color_palette'], false, 'yml');
          if ($colors_file) {
    			  $colors_array = Spyc::YAMLLoad($colors_file);
    			  self::$colors = $colors_array;
          } else {
    			  self::$colors = array();
          }
        }
      } else {
        self::$options = array();
      }
    }
  }
}