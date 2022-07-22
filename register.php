<?php include_once("./classes/register.class.php") ?>
<?php include_once("./classes/database.class.php") ?>
<?php
function clear_data($val){
    $val = trim($val);
    $val = stripslashes($val);
    $val = strip_tags($val);
    $val = htmlspecialchars($val);
    return $val;
}
if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
  $username = clear_data($_POST['username']);
  $email = clear_data($_POST['email']);
  $password = clear_data($_POST['password']);
  $repeatedPassword = clear_data($_POST['password-repeat']);
  $name = clear_data($_POST['name']);
  // $res = $database->update($username, $password, $repeatedPassword); // accepts newPassword as third param
  // echo json_encode($res); // change password

  // $res = $database->read($username);
  // echo json_encode($res); // get User from json

  // $res = $database->delete($username);
  // echo json_encode($res); // delete User from json


  $user =  $database->create($username, $password, $repeatedPassword, $email, $name);
  $errors = $user->errors;
  if(empty($errors)) {
    http_response_code(201);
    echo json_encode(['success' => true]);
  }
  else {
    http_response_code(400);
    echo json_encode([
    'success' => false,
    'errors' => $errors,
    ]);
  }
}
?>

