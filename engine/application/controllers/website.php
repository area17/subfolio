<?php defined('SYSPATH') or die('No direct script access.');
class Website_Controller extends Template_Controller {
  var $auth;
  
  public $template = "layouts/template";

	public function __construct() {
		parent::__construct();
 		$this->session = Session::instance(); 

    require (Kohana::find_file('vendor','classTextile'));

    $this->auth        = Auth::instance();
    $this->access      = Access::instance();
    $this->filebrowser = Filebrowser::instance();
    $this->filekind    = FileKind::instance();
 		
    Subfolio::set_filebrowser($this->filebrowser);
    Subfolio::set_auth($this->auth);
    Subfolio::set_template($this->template);
    Subfolio::set_filekind($this->filekind);
    
 		$this->template->site_title = Kohana::config('filebrowser.site_name');
 		$this->template->page_title = "Home";
 	}
}