<?php 
  require_once '../admin/php/connection.php';
  
  $sql = 'SELECT username, first_name, last_name FROM customer WHERE username="' . $_GET['username'] . '";';
  $db = open_connection();
  $stmt = $db->prepare($sql);
  $stmt->execute();
  
  if($customer = $stmt->fetch(PDO::FETCH_ASSOC)) {
    print(json_encode($customer));
  } else {
    print('null');
  }
?>