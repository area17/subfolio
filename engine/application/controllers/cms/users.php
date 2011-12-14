<?php defined('SYSPATH') or die('No direct script access.');
class Users_Controller extends Cms_Controller {

  public function __construct() {
    parent::__construct();
    $this->check_access();
    $this->template->content = $this->load_nav();
  }

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
          } else {
            $user['admin'] = 'false';
          }

          $this->auth->add_user($_POST['name'], $user);
          $this->auth->save_users();
          $this->session->set_flash('flash', 'User created');
          url::redirect(SubfolioTheme::get_site_root()."-cms/users/edit/".$_POST['name']); 
          exit();
        } else {
          $errors['name'] = "Username already exists";
        }
      }
    } else {
      url::redirect(SubfolioTheme::get_site_root()."-cms/users/add"); 
      exit();
    }
  
    $content = View::factory('cms/users/add');
    $content->errors = $errors;
    $this->template->content .= $content;

  }

  public function edit($username) {
    $errors = array();
    $userArray = $this->auth->get_user_by_name($username);
    if (!$userArray) {
      url::redirect(SubfolioTheme::get_site_root()."-cms/users"); 
      $this->session->set_flash('flash', 'User not found');
      exit();
    }
    $user = new User($username, $userArray);

    if ($_POST) {
      $errors = $this->_validate_user_update($_POST);
      if (sizeof($errors) == 0) {
        if (isset($_POST['fullname'])) {
          $userArray['fullname'] = $_POST['fullname'];
        }

        if (isset($_POST['password']) && $_POST['password'] <> '') {
          if (isset($_POST['hash_password']) && $_POST['hash_password'] == 1) {
            $userArray['hashed_password'] = $this->auth->hash($_POST['password']);
            unset($userArray['password']);
          } else {
            $userArray['password'] = $_POST['password'];
            unset($userArray['hashed_password']);
          }
        }

        if (isset($_POST['is_admin']) && $_POST['is_admin'] == 1) {
          $userArray['admin'] = 'true';
        } else {
          $userArray['admin'] = 'false';
        }

        $this->auth->add_user($username, $userArray);
        $this->auth->save_users();
        $this->session->set_flash('flash', 'User updated');
        url::redirect(SubfolioTheme::get_site_root()."-cms/users/edit/".$username); 
        exit();
      }
    }

    $content = View::factory('cms/users/edit');
    $content->groups = $this->auth->groups();
    $content->auth = $this->auth;
    $content->user = $user;
    $content->errors = $errors;
    $this->template->content .= $content;
  }

  public function delete($username) {
    $errors = array();
    $userArray = $this->auth->get_user_by_name($username);
    if (!$userArray) {
      $this->session->set_flash('flash', 'User not found');
      url::redirect(SubfolioTheme::get_site_root()."-cms/users"); 
      exit();
    }
    $user = new User($username, $userArray);

    // remove from groups
    $groups = $this->auth->user_group_list($user);
    foreach ($groups as $group) {
      if (!$this->auth->remove_user_from_group($username, $group)) {
        $this->session->set_flash('flash', 'Remove failed please try again');
        url::redirect(SubfolioTheme::get_site_root()."-cms/users/edit/".$username); 
        exit();
      }
    }
    $this->auth->save_groups();

    // delete the user
    $this->auth->delete_user($username);
    $this->auth->save_users();
    
    $this->session->set_flash('flash', 'User deleted');
    url::redirect(SubfolioTheme::get_site_root()."-cms/users"); 
    exit();
  }

  public function addtogroup($username) {
    $errors = array();
    $userArray = $this->auth->get_user_by_name($username);
    if (!$userArray) {
      $this->session->set_flash('flash', 'User not found');
      url::redirect(SubfolioTheme::get_site_root()."-cms/users"); 
      exit();
    }

    if (!isset($_GET['group'])) {
      $this->session->set_flash('flash', 'No group');
      url::redirect(SubfolioTheme::get_site_root()."-cms/users/edit/".$username); 
      exit();
    }
    if (!$this->auth->add_user_to_group($username, $_GET['group'])) {
      $this->session->set_flash('flash', 'Add failed please try again');
      url::redirect(SubfolioTheme::get_site_root()."-cms/users/edit/".$username); 
      exit();
    }
    $this->auth->save_groups();
    $this->session->set_flash('flash', 'Added to group');
    url::redirect(SubfolioTheme::get_site_root()."-cms/users/edit/".$username); 
    exit();
  }

  public function removefromgroup($username) {
    $errors = array();
    $userArray = $this->auth->get_user_by_name($username);
    if (!$userArray) {
      url::redirect(SubfolioTheme::get_site_root()."-cms/users"); 
      exit();
    }
    if (!isset($_GET['group'])) {
      $this->session->set_flash('flash', 'No group');
      url::redirect(SubfolioTheme::get_site_root()."-cms/users/edit/".$username); 
      exit();
    }
    if (!$this->auth->remove_user_from_group($username, $_GET['group'])) {
      $this->session->set_flash('flash', 'Remove failed please try again');
      url::redirect(SubfolioTheme::get_site_root()."-cms/users/edit/".$username); 
      exit();
    }
    $this->auth->save_groups();
    $this->session->set_flash('flash', 'Removed from group');
    url::redirect(SubfolioTheme::get_site_root()."-cms/users/edit/".$username); 
    exit();
  }

  // ------------------------------------------------------
  // PRIVATE
  // ------------------------------------------------------

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

  private function _validate_user_update($data) {
    $errors = array();

    // password
    if (isset($data['password']) && $data['password'] <> '') {
      if (strlen($data['password']) < 4) {
        $errors['password'] = 'Password must be at least 4 characters';
      }

      // password_again
      if (!isset($data['password_again']) || $data['password_again'] == '') {
        $errors['password_again'] = 'Password confirmation is required';
      } else if ($data['password_again'] <> $data['password']) {
        $errors['password_again'] = 'Password and confirmation do not match';
      }
    }

    // hash_password: no validation
    // fullname: no validation

    return $errors;
  }

}

