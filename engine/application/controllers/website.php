<?php defined('SYSPATH') or die('No direct script access.');
class Website_Controller extends Template_Controller {
  var $auth;
  
  public $template = "layouts/template";

	public function __construct() {
		parent::__construct();
 		$this->session = Session::instance(); 

    $this->auth        = Auth::instance();
    $this->access      = Access::instance();
    $this->filebrowser = Filebrowser::instance();
    $this->filekind    = FileKind::instance();
 		
 		$this->template->site_title = Kohana::config('filebrowser.site_name');
 		$this->template->page_title = "Home";
 	}
}