<?php defined('SYSPATH') or die('No direct script access.');
class Groups_Controller extends Cms_Controller {

  public function __construct() {
    parent::__construct();
    $this->check_access();
    $this->template->content = $this->load_nav();
  }

  public function index() {
    $content = View::factory('cms/groups/index');
    $content->groups = $this->auth->groups();
    $this->template->content .= $content;
  }

  public function view($groupname) {
    $errors = array();
    $groupArray = $this->auth->get_group_by_name($groupname);
    if (!$groupArray) {
      $this->session->set_flash('flash', 'Group not found');
      url::redirect(SubfolioTheme::get_site_root()."-cms/groups"); 
      exit();
    }

    $content = View::factory('cms/groups/view');
    $content->groupname = $groupname;
    $content->group = $groupArray;
    $this->template->content .= $content;
  }

  public function add() {
    $content = View::factory('cms/groups/add');
    $this->template->content .= $content;
  }

  public function create() {
    $errors = array();
    if ($_POST) {
      $errors = $this->_validate_group($_POST);
      if (sizeof($errors) == 0) {
        // check to see if this user exists already
        if (!$this->auth->is_group($_POST['name'])) {
          $group = array('-');

          $this->auth->add_group($_POST['name'], $group);
          $this->auth->save_groups();
          $this->session->set_flash('flash', 'Group created');
          url::redirect(SubfolioTheme::get_site_root()."-cms/groups/view/".$_POST['name']); 
          exit();
        } else {
          $errors['name'] = "Group already exists";
        }
      }
    } else {
      url::redirect(SubfolioTheme::get_site_root()."-cms/groups/add"); 
      exit();
    }
  
    $content = View::factory('cms/groups/add');
    $content->errors = $errors;
    $this->template->content .= $content;  
  }


  public function delete($groupname) {
    $errors = array();
    $groupArray = $this->auth->get_group_by_name($groupname);
    if (!$groupArray) {
      $this->session->set_flash('flash', 'Group not found');
      url::redirect(SubfolioTheme::get_site_root()."-cms/groups"); 
      exit();
    }

    // delete the user
    $this->auth->delete_group($groupname);
    $this->auth->save_groups();
    
    $this->session->set_flash('flash', 'Group deleted');
    url::redirect(SubfolioTheme::get_site_root()."-cms/groups"); 
    exit();
  }


  // ------------------------------------------------------
  // PRIVATE
  // ------------------------------------------------------

  private function _validate_group($data) {
    $errors = array();

    // name
    if (!isset($data['name']) || $data['name'] == '') {
      $errors['name'] = 'Name is required';
    } else if (strlen($data['name']) > 32) {
      $errors['name'] = 'Name must be less than 32 characters';
    } else if (!preg_match('/^[a-z0-9]+$/i', $data['name'])) {
      $errors['name'] = 'Name must contain only alpha numeric characters';
    }

    return $errors;
  }
}
