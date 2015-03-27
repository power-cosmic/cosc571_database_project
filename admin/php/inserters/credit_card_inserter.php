<?php
include_once 'admin/php/connection.php';

class Credit_card_inserter {
  
  private $select_sql = "SELECT number
      FROM credit_card
      WHERE number=:number;";
  
  private $insert_sql = "INSERT INTO credit_card (
        number, issuer, expiration, username
      ) VALUES (
        :number,
        :issuer,
        :expiration,
        :username
      );";

  private $db;
  
  function __construct($db) {
    $this->db = $db;
  }
  
  function insert($card) {
    
    $stmt = $this->db->prepare($this->select_sql);
    $stmt->execute([
        'number' => $card['number']
    ]);

    // check if card is already in db
    if ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
      $number = $result['number'];
      $new_entry = false;
    }
    
    // if it's not there, add it
    else {
      $stmt = $this->db->prepare($this->insert_sql);
      $stmt->execute($card);
      $number = $this->db->lastInsertId();
      $new_entry = true;
    }
    
    // return both the card number, and if it was new
    return [
        'number' => $number,
        'new' => $new_entry
    ];
  }
  
}

?>