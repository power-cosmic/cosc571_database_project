<?php
require_once '../connection.php';
require_once '../book_info.php';
require_once '../cart.php';

session_start();

$status = 'success';
$cart = Cart::get_instance();
$isbn = $_POST['isbn'];

switch($_POST['action']) {
  case 'delete':
    $cart->remove_item($isbn);
    $line_cost = 0;
    break;
  case 'add':
    $cart->add_item($isbn);
    $line_cost = $cart->get_price($isbn);
    break;
  case 'alter':
    $quantity = intval($_POST['quantity']);
    $cart->set_quantity($isbn, $quantity);
    $line_cost = $cart->get_price($isbn);
    break;
  default:
    $status = 'fail';
    break;
}

echo json_encode([
    'status' => $status,
    'lineCost' => $line_cost,
    'num_items' => $cart->num_in_cart(),
    'subtotal' => $cart->get_subtotal()
]);

?>