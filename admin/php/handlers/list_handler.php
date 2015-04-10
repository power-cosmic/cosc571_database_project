<?php
require_once '../connection.php';
require_once '../login.php';

session_start();

$status = 'success';
$isbn = $_POST['isbn'];
$login = Login::get_instance();

switch($_POST['action']) {
  case 'add':
    $login->add_to_wishlist($isbn);
    break;
  default:
    $status = 'fail';
    break;
}

echo json_encode([
    'status' => $status
]);

?>