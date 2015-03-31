<?php
require_once '../connection.php';
require_once '../constants.php';
require_once '../login.php';

session_start();

$status = 'fail';
$message = null;
$login = Login::get_instance();

switch($_POST['action']) {
  case 'customer_login':
    $success = $login->customer_login($_POST['username'], $_POST['password']);
    if ($success) {
      $status = 'success';
    } else {
      $message = 'Invalid username or password';
    }
    break;
  case 'admin_login':
    $success = false;
    if ($success) {
      $status = 'success';
    } else {
      $message = 'Invalid username or password';
    }
    break;
  case 'logout' :
    $login->log_out();
    $status = 'success';
    break;
  default:
    
    break;
}

echo json_encode([
    'status' => $status,
    'message' => $message
]);

?>