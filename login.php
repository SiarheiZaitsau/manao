<?php require("./classes/login.class.php") ?>
<?php

if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
  $username = $_POST['username'];
  $password = $_POST['password'];

  $user = new LoginUser($username, $password);
  $success = $user->success;
  $error = $user->error;
  if($success) {
    echo json_encode([
    'success' => true,
    ]);
  }
  else {
    http_response_code(400);
    echo json_encode([
    'success' => false,
    'errors' => $error
    ]);
  }
}
?>