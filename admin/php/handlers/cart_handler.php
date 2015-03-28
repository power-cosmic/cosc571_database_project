<?php
require_once '../connection.php';
require_once '../cart.php';

session_start();

switch($_POST['action']) {
  case 'delete':
    $cart = Cart::get_instance();
    $cart->remove_item($_POST['isbn']);
    echo json_encode([
        'status' => 'success',
        'subtotal' => $cart->get_subtotal()
    ]);
    break;
}


?>