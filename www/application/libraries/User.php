<?php
class User {
  var $name;
  var $fullname;
  var $password;
  var $hashed_password;
  var $admin;
  
  public function __construct($name, $array) {
    $this->name     = $name;
        
    $this->password        = isset($array['password']) ? $array['password'] : '';
    $this->hashed_password = isset($array['hashed_password']) ? $array['hashed_password'] : '';
    $this->admin           = isset($array['admin']) ? $array['admin'] : false;
  }
  
}
?>