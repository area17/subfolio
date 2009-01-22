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

      $s = array('bytes', 'kb', 'MB', 'GB', 'TB', 'PB');
      $e = floor(log($bytes)/log(1024));

      $output = sprintf('%.0f '.$s[$e], ($bytes/pow(1024, floor($e))));

      //SEND OUTPUT TO BROWSER
      return $output;

    }
    return "";
	}

	public static function filedate($date, $format="M d, Y") {
	  return date($format, $date);
  }

} // End format