<?php defined('SYSPATH') OR die('No direct access allowed.');
class format extends format_Core {

	/**
	 * Formats a file size to contain a protocol at the beginning.
	 *
	 * @param   string  possibly incomplete URL
	 * @return  string
	 */
	public static function filesize($bytes) {
    if(!empty($bytes)) {

      $s = array('B', 'KB', 'MB', 'GB', 'TB', 'PB');
      $e = floor(log($bytes)/log(1024));

      $se = "";
      if (isset($s[$e])) $se = $s[$e];
      $output = sprintf('%.0f '.$se, ($bytes/pow(1024, floor($e))));

      //SEND OUTPUT TO BROWSER
      return $output;

    }
    return "";
	}

	public static function filedate($date, $format="M d, Y") {
	  return date($format, $date);
  }

  public static function filename($name, $show_ext=true) {
    $filename = $name;
    if ($show_ext) {
      $filename = $name;
    } else {
      $extension ="";
      $path_parts = pathinfo($name);
      if (isset($path_parts['extension'])) {
        $extension = $path_parts['extension'];
      }
      if ($extension) {
        $filename = substr($name, 0, (-1 * strlen($extension)-1));
      }
    }
    return $filename;
  }

	public static function get_rendered_text($text) {
    $style = Kohana::config('filebrowser.text_rendering');
    if ($style == "textile") {
			$textile = new Textile();
			return $textile->TextileThis($text);
    } else if ($style == "markdown") {
			return Markdown($text);
    } else {
    	return $text;
    }
	}

  public static function urlencode_parts($path) {
    $ret = "";
    $parts = explode("/", $path);
    
    foreach ($parts as $part) {
      if ($ret != "") {
        $ret .= "/";
      }
      $ret .= "".urlencode($part);
    }
    
    return $ret;
  }

} // End format
