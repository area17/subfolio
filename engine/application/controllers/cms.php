<?php defined('SYSPATH') or die('No direct script access.');
class Cms_Controller extends Website_Controller {

  protected function load_nav() {
    $nav = View::factory("cms/nav");
    return $nav;
  }

  protected function check_access() {
    if (!$this->auth->logged_in()) {
      $this->session->set('return_path', "/-cms");
      url::redirect("/login"); 
    }
    $current_user = $this->auth->get_user();
    if (!$current_user->admin) {     
      url::redirect("/denied"); 
    }
  }

}
