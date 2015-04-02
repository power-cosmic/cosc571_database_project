<?php
include_once '../admin/php/connection.php';
require_once '../admin/php/inserters/address_inserter.php';
require_once '../admin/php/inserters/credit_card_inserter.php';
require_once '../admin/php/inserters/customer_inserter.php';

// open db connection and create db interaction elements
$db = open_connection();
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$address_inserter = new Address_inserter($db);
$card_inserter = new Credit_card_inserter($db);
$customer_inserter = new Customer_inserter($db);

$success = false;
if ($customer_inserter->does_exist($_POST['username'])) {
  $error_message = 'Username is taken: '. $_POST['username'];
} else {
  $address_info = [
    'street_address' => $_POST['address'],
    'city' => $_POST['city'],
    'zip' => $_POST['zip'],
    'state' => $_POST['state'],
  ];
  $address_id = $address_inserter->insert($address_info)['id'];

  $customer_inserter->insert([
    'username' => $_POST['username'],
    'password' => $_POST['password'],
    'first_name' => $_POST['first-name'],
    'last_name' => $_POST['last-name'],
    'address_id' => $address_id
  ]);

  $card_id = $card_inserter->insert([
    'username' => $_POST['username'],
    'number' => $_POST['card-number'],
    'issuer' => $_POST['card-type'],
    'expiration' => $_POST['card-expiration']
  ]);
  
  // insert customer, address into lookup table
  $query = 'INSERT INTO customer_address
      VALUES("' . $_POST['username'] . '", ' . $address_id . ');';
  $stmt = $db->prepare($query);
  $stmt->execute();
  
  // put card number into customer
  // TODO: do this when initially adding customer
  $query = 'UPDATE customer
      SET card_number = :card_number
      WHERE username = :username;';
  $stmt = $db->prepare($query);
  $stmt->execute([
      'card_number' => $_POST['card-number'],
      'username' => $_POST['username']
  ]);
  
  $success = true;
}

if ($success) {
  echo json_encode([
      'status' => 'success',
      'info' => $_POST
  ]);
} else {
  echo json_encode([
      'status' => 'fail',
      'info' => $error_message
  ]);
}
?>