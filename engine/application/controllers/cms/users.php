<?php defined('SYSPATH') or die('No direct script access.');
class Users_Controller extends Cms_Controller {
  public function index() {
    $content = View::factory('cms/users/index');
    $content->users = $this->auth->users();
    $this->template->content .= $content;
  }

  public function add() {
    $content = View::factory('cms/users/add');
    $this->template->content .= $content;
  }

  public function create() {
    $errors = array();
    if ($_POST) {
      $errors = $this->_validate_user($_POST);
      if (sizeof($errors) == 0) {
        // check to see if this user exists already
        if (!$this->auth->is_user($_POST['name'])) {
          $user = array();
          if (isset($_POST['fullname'])) {
            $user['fullname'] = $_POST['fullname'];
          }

          if (isset($_POST['hash_password']) && $_POST['hash_password'] == 1) {
            $user['hashed_password'] = $this->auth->hash($_POST['password']);
          } else {
            $user['password'] = $_POST['password'];
          }

          if (isset($_POST['is_admin']) && $_POST['is_admin'] == 1) {
            $user['admin'] = 'true';
          }

          $this->auth->add_user($_POST['name'], $user);
          $this->auth->save_users();
          url::redirect(SubfolioTheme::get_site_root()."-cms/users/edit/".$_POST['name']); 
        } else {
          $errors['name'] = "Username already exists";
        }
      }
    } else {
      url::redirect(SubfolioTheme::get_site_root()."-cms/users/add"); 
    }
  
    $content = View::factory('cms/users/add');
    $content->errors = $errors;
    $this->template->content .= $content;

  }

  public function edit($username) {
  }

  public function delete($username) {
  }

  public function __construct() {
    parent::__construct();
    $this->check_access();
    $this->template->content = $this->load_nav();
  }


  private function _validate_user($data) {
    $errors = array();

    // name
    if (!isset($data['name']) || $data['name'] == '') {
      $errors['name'] = 'Name is required';
    } else if (strlen($data['name']) > 32) {
      $errors['name'] = 'Name must be less than 32 characters';
    } else if (!preg_match('/^[a-z0-9]+$/i', $data['name'])) {
      $errors['name'] = 'Name must contain only alpha numeric characters';
    }

    // password
    if (!isset($data['password']) || $data['password'] == '') {
      $errors['password'] = 'Password is required';
    } else if (strlen($data['password']) < 4) {
      $errors['password'] = 'Password must be at least 4 characters';
    }

    // password_again
    if (!isset($data['password_again']) || $data['password_again'] == '') {
      $errors['password_again'] = 'Password confirmation is required';
    } else if ($data['password_again'] <> $data['password']) {
      $errors['password_again'] = 'Password and confirmation do not match';
    }

    // hash_password: no validation
    // fullname: no validation

    return $errors;
  }
}

