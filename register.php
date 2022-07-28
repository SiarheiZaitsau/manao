<?php include_once("./classes/register.class.php") ?>
<?php include_once("./classes/database.class.php") ?>
<?php

if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
  $username = $_POST['username'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $repeatedPassword = $_POST['password-repeat'];
  $name = $_POST['name'];

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

