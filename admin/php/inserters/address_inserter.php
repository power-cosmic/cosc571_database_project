<?php
include_once 'admin/php/connection.php';

class Address_inserter {
  
  private $select_sql = "SELECT id
      FROM address
      WHERE street_address=:street_address
        AND city=:city
        AND zip=:zip
        AND state=:state;";
  
  private $insert_sql = "INSERT INTO address (
        street_address, city, zip, state
      ) VALUES (
        :street_address,
        :city,
        :zip,
        :state
      );";

  private $db;
  
  function __construct($db) {
    $this->db = $db;
  }
  
  function insert($address) {
    
    $stmt = $this->db->prepare($this->select_sql);
    $stmt->execute($address);
    
    // check if address is already in db
    if ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
      $address_id = $result['id'];
      $new_entry = false;
    }
    
    // if it's not there, add it
    else {
      $stmt = $this->db->prepare($this->insert_sql);
      $stmt->execute($address);
      $address_id = $this->db->lastInsertId();
      $new_entry = true;
    }
    
    // return both the address, and if it was new
    return [
        'id' => $address_id,
        'new' => $new_entry
    ];
  }
  
}

?>