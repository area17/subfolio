<?php
class FileKind {
  var $config_name    = "filebrowser";
  var $kinds          = array();

  public function __construct($config_name='filebrowser')
  {
    $this->config = Kohana::config($config_name);
    $this->config_name = $config_name;

    // load kinds from file
    $list_file = $this->config['filekinds_yaml_file'];

    if (file_exists($list_file)) {
      $this->kinds = Spyc::YAMLLoad($list_file);
    }
    //rint_r($this->kinds);

    //$this->_test();
  }

	public static function instance($config_name='filebrowser') {
    static $instance;
    empty($instance) and $instance = new FileKind($config_name);
    return $instance;
	}

  public function get_icon_by_file($kind) {
    $icon_file = "gen";
    if ($kind) {
			$icon_file = "" . $kind['icon'];
    }
    return $icon_file;
  }

  public function get_kind_by_file($file) {
    $extension ="";
    $path_parts = pathinfo($file);
    if (isset($path_parts['extension'])) {
      $extension = $path_parts['extension'];
    }
    return $this->get_kind_by_extension($extension);
  }

  public function get_kind_by_extension($ext)
  {
    $kind = array();
    if (sizeof($this->kinds) > 0) {
      foreach($this->kinds as $k => $v) {
        if (in_array(strtolower($ext), $v['extensions'])) {
          $kind = $v;
          $kind['kind'] = $k;

          break;
        }
      }
    }
    return $kind;
  }

  private function _test()
  {
    print "<pre>";
    /*
    $kind = $this->get_kind_by_extension("gif");
    print "get_icon_by_file('mubs-test.gif') \n";
    print_r($this->get_icon_by_file('mubs-test.gif'));
    */

    print "get_kind_by_file('abc.tar') \n";
    print_r($this->get_kind_by_file('abc.tar'));

    print "get_kind_by_extension('png') \n";
    print_r($this->get_kind_by_extension('png'));
    print "get_kind_by_extension('mov') \n";
    print_r($this->get_kind_by_extension('mov'));
    print "</pre>";
  }
}