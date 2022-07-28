<?php
include_once("register.class.php");
class Database{
	
  public $res;
  private $storage = 'data.json';
  
	function __construct(){
    $this-> stored_users = json_decode(file_get_contents($this-> storage), true);
	}
 
 
	public function read($id){
		if($this-> getUser($id)) {
      return ($this-> getUser($id));
    }
    else {
      return 'No such user';
    }
	}
 
	public function update($id, $fieldname, $newValue){
  foreach($this->stored_users as &$user) {
    if($user['id'] == $id) {
      $user[$fieldname] = $newValue;
      file_put_contents('data.json', json_encode(array_values($this->stored_users)));
      return 'User successfully changed';
  }
  }
  return 'Incorrect entry';
}                
 
	public function delete($id){
    if(($key = array_search($id, array_column($this-> stored_users, 'username'))) !== false) {
    unset($this-> stored_users[$key]);
    file_put_contents('data.json', json_encode(array_values($this-> stored_users)));
    return "user with {$id} successfully deleted";
    }   
 	  return "User Not Found";
	}

  public function create($username, $password, $repeatedPassword, $email, $name){
    $user = new Register($username, $password, $repeatedPassword, $email, $name);
    return $user;
  }

 private function getUser($id) {
  foreach($this->stored_users as $user) {
    if($user['id'] == $id) {
      return $user;
    }
    else {
      return 'No such user';
    }
   }
  }
}
 $database = new Database();
?>