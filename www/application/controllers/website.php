<?php defined('SYSPATH') or die('No direct script access.');
class Website_Controller extends Template_Controller {
  var $auth;

	public function __construct() {
		parent::__construct();
 		$this->session = Session::instance(); 

    $this->auth = Auth::instance();
 		
 		$this->template->site_title = "Filebrowser2";
 		$this->template->page_title = "Home";
 	}
}