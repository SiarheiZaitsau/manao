<?php require("./classes/login.class.php") ?>
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
  $password = clear_data($_POST['password']);

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