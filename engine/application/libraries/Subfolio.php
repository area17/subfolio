<?php 
/**
 * 
 */
class Subfolio {
  public static $filebrowser;
  public static $auth;
  
  public static function set_filebrowser($_filebrowser) {
    Subfolio::$filebrowser = $_filebrowser;
  }
  public static function set_auth($_auth) {
    Subfolio::$auth = $_auth;
  }
}

class SubfolioTheme {

  // ------------------------------------------------------
  // TEMPLATE RELATED FUNCTIONS
  // ------------------------------------------------------

  public static function get_mobile_viewport()
  {
    return (SubfolioTheme::is_iphone());
  }
  
  public static function is_iphone()
  {
    if (strstr($_SERVER['HTTP_USER_AGENT'],'iPhone') || strstr($_SERVER['HTTP_USER_AGENT'],'iPod')) {
      return true;
    } else {
      return false;
    }
  }

  public static function get_page_title()
  {
  }

  public static function get_site_title()
  {
  }

  public static function get_site_name()
  {
  }
  
  public static function get_view_url()
  {
    
  }
  
  public static function get_listing_mode()
  {
  	$listing_mode = Kohana::config('filebrowser.listing_mode');
  	$listing_mode = view::get_option('listing_mode', $listing_mode);
  	$listing_mode = Subfolio::$filebrowser->get_folder_property('listing_mode', $listing_mode); 
  	
  	return $listing_mode;
  }
  
  public static function get_notice($name=null)
  {
    if ($name == null) {
      $name = 'flash';
    }
    return Session::instance()->get($name);
  }

  // ------------------------------------------------------
  // THEME RELATED FUNCTIONS
  // ------------------------------------------------------
 
  public static function get_option($option_name, $default_value)
  {
    return view::get_option($option_name, $default_value);
  }
}


class SubfolioUser {
  // ------------------------------------------------------
  // USER RELATED FUNCTIONS
  // ------------------------------------------------------
  public function is_logged_in()
  {
    return Subfolio::$auth->logged_in();
  }
}

class SubfolioLanguage {
  // ------------------------------------------------------
  // LANGUAGE RELATED FUNCTIONS
  // ------------------------------------------------------
  public function get_text($name)
  {
    return Kohana::lang($name);
  }
}

?>