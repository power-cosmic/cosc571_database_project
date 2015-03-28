<?php
require_once '../connection.php';
require_once '../cart.php';

session_start();

$status = 'success';
$cart = Cart::get_instance();
$isbn = $_POST['isbn'];

switch($_POST['action']) {
  case 'delete':
    $cart->remove_item($isbn);
    break;
  case 'add':
    $cart->add_item($isbn);
    break;
  case 'alter':
    $quantity = $_POST['quantity'];
    $cart->set_quantity($isbn, $quantity);
    break;
  default:
    $status = 'fail';
    break;
}

echo json_encode([
    'status' => $status,
    'subtotal' => $cart->get_subtotal()
]);

?>