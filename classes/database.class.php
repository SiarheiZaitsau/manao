<?php
include_once("register.class.php");
class Database{
	
  public $res;
  private $storage = 'data.json';
  
	function __construct(){
    $this-> stored_users = json_decode(file_get_contents($this-> storage), true);
	}
 
 
	public function read($username){
		if($this-> getUser($username)) {
      return ($this-> getUser($username));
    }
    else {
      return 'No such user';
    }
	}
 
	public function update($username, $password, $newPassword){
  foreach($this->stored_users as &$user) {
    if($user['username'] == $username) {
      if(password_verify($password, $user['password'])) {
        $user['password'] = password_hash($newPassword, PASSWORD_DEFAULT);
        file_put_contents('data.json', json_encode(array_values($this->stored_users)));
        return 'Password successfully changed';
    }
  }
  }
  return 'Incorrect entry';
}   
// change password                
 
	public function delete($username){
    if(($key = array_search($username, array_column($this-> stored_users, 'username'))) !== false) {
    unset($this-> stored_users[$key]);
    file_put_contents('data.json', json_encode(array_values($this-> stored_users)));
    return "{$username} successfully deleted";
}   
 		return "User Not Found";
	}

  public function create($username, $password, $repeatedPassword, $email, $name){
    $user = new Register($username, $password, $repeatedPassword, $email, $name);
    return $user;
  }
 
}
 
 $database = new Database();
?>