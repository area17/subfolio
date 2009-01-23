<?php
/**
 *
 * Based on code found on Kohana Forums
 *
 */
class View extends View_Core {
  public function set_filename($name, $type = NULL) {
    $theme = Kohana::config('filebrowser.theme');
    if (Kohana::find_file('../../../config/themes/'.$theme.'/', $name))
      parent::set_filename('../../../config/themes/'.$theme.'/'.$name, $type);
    elseif (Kohana::find_file('../../../config/themes/default/', $name))
      parent::set_filename('../../../config/themes/default/'.$name, $type);
    else
      parent::set_filename('../../../config/themes/'.$theme.'/'.$name, $type);
    return $this;
  }

  public function get_view_url() {
    $theme = Kohana::config('filebrowser.theme');
    return "/config/themes/".$theme;
  }
}