<?php defined('SYSPATH') or die('No direct script access.');
class Home_Controller extends Cms_Controller {

  public function index() {
    $content = View::factory('cms/home/index');
    $this->template->content .= $content;
  }

  public function __construct() {
    parent::__construct();
    $this->check_access();
    $this->template->content = $this->load_nav();
  }

}
