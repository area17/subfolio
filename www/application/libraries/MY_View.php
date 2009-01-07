<?php
/**
 * S7Ncms - www.s7n.de
 *
 * Copyright (c) 2007-2008, Eduard Baun <eduard at baun.de>
 * All rights reserved.
 *
 * See license.txt for full text and disclaimer
 *
 * @author Eduard Baun <eduard at baun.de>
 * @copyright Eduard Baun, 2007-2008
 * @version $Id$
 */
class View extends View_Core {
  public function set_filename($name, $type = NULL) {
    $theme = Kohana::config('filebrowser.theme');
    if (Kohana::find_file('views/'.$theme.'/', $name))
      parent::set_filename($theme.'/'.$name, $type);
    elseif (Kohana::find_file('views/default/', $name))
      parent::set_filename('default/'.$name, $type);
    else
      parent::set_filename($name, $type);
    
    return $this;
  }
}