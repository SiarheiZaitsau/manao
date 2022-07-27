<?php 
class Register {
  private $username;
  private $email;
  private $name;
  private $raw_password;
  private $repeated_password;
  private $encrypted_password;
  public $errors;
  public $success;
  private $storage = 'data.json';
  private $new_user;

  public function __construct($username, $password, $repeated_password, $email, $name) {
    $this-> username = filter_var(trim($username), FILTER_SANITIZE_STRING);
    $this-> email = filter_var(trim($email), FILTER_SANITIZE_STRING);
    $this-> name = filter_var(trim($name), FILTER_SANITIZE_STRING);
    $this-> errors = array();
    $this-> raw_password = filter_var(trim($password), FILTER_SANITIZE_STRING);
    $this-> repeated_password = filter_var(trim($repeated_password), FILTER_SANITIZE_STRING);
    $this-> encrypted_password = password_hash($this -> raw_password, PASSWORD_DEFAULT);
    $this-> stored_users = json_decode(file_get_contents($this-> storage), true);
    $this-> new_user = [
      "username" => $this-> username,
      "password" => $this-> encrypted_password,
      "email" => $this -> email,
      "name" => $this -> name,
    ];

    $this-> checkFieldValues();
    $this-> validateUsername($username);
    $this-> validatePassword($password, $repeated_password);
    $this-> validateEmail($email);
    $this-> validateName($name);
    if(empty($this -> errors)) {
      $this-> insertUser();
    }
  }
  private function validateUsername ($usernameToVerify) {
    if(strlen($usernameToVerify) < 6) {
      $this-> errors['username'] = "Username should be at least 6 characters!";
      return false;
    }
      if(preg_match('/\s/', $usernameToVerify)) {
        $this-> errors['username'] = "Spaces not allowed!";
      return false;
      }
    return true;
  }
  private function validatePassword ($passwordToVerify, $repeated_passwordToVerify) {
    if($passwordToVerify != $repeated_passwordToVerify) {
      $this-> errors['password'] = "Passwords didn't match";
      return false;
    }
    if(strlen($passwordToVerify) < 6 || !preg_match("/[0-9]/", $passwordToVerify) || !preg_match('/[A-Za-z]/', $passwordToVerify)) {
      $this-> errors['password'] = "Password should be at least 6 characters and contain an number";
      return false;
    }
    if(preg_match('/\s/', $passwordToVerify)) {
      $this-> errors['password'] = "Spaces not allowed!";
    return false;
      }
    return true;
  }
  private function validateEmail($emailToVerify) {
    if(!filter_var($emailToVerify, FILTER_VALIDATE_EMAIL)) {
        $this-> errors['email'] = "Incorrect email address";
        return false;
    } else {
        return true;
    }
}
  private function validateName($nameToVerify) {
    if(!strlen($nameToVerify) <= 2 && !ctype_alpha($nameToVerify)) {
      $this-> errors['name'] = "Name should contain at least 2 characters and only letters allowed";
        return false;
    } else {
        return true;
    }
}

  private function checkFieldValues(){
    if(empty($this-> username) || empty($this-> raw_password) || empty($this-> repeated_password) || empty($this-> email) || empty($this-> name)) {
      $this-> errors['global'] = "All fields are required";
      return false;
    }
    else {
      return true;
    }
  
}
  private function isFieldUnique($value, $fieldName){
    foreach($this->stored_users as $user) {
      if(strtolower($value) == strtolower($user[$fieldName])) {
        if($fieldName == 'username') {
          $this-> errors[$fieldName] = "User already exist";
        }
        if($fieldName == 'email') {
          $this-> errors[$fieldName] = "Email is already in use";
        } 
        return false;
      }
    }
    return true;
  }

  private function insertUser(){
    if($this-> isFieldUnique($this-> username, "username") == TRUE && $this-> isFieldUnique($this-> email, "email") == TRUE) {
      array_push($this-> stored_users, $this-> new_user);
      if(file_put_contents($this-> storage, json_encode($this-> stored_users, JSON_PRETTY_PRINT))) {
        return $this-> success = "User successfully registered";
      }
      else {
         $this-> errors['username'] = "Something went wrong!"; 
      }
    }
  }
  function clear_data($val){
    $val = trim($val);
    $val = stripslashes($val);
    $val = strip_tags($val);
    $val = htmlspecialchars($val);
    return $val;
}
}
?>