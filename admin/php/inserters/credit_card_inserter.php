<?php

class Credit_card_inserter {

  private $select_sql = "SELECT number
      FROM credit_card
      WHERE number=:number;";

  private $insert_sql = "INSERT INTO credit_card (
        number, issuer, expiration
      ) VALUES (
        :number,
        :issuer,
        DATE(:expiration)
      );";

  private $insert_lookup_sql = "INSERT INTO customer_credit_card
        VALUES
      (
        :username,
        :card_number
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
      $stmt->execute([
          'number' => $card['number'],
          'issuer' => $card['issuer'],
          'expiration' => $card['expiration']
      ]);

      $number = $card['number'];
      $new_entry = true;
      
      $stmt = $this->db->prepare($this->insert_lookup_sql);
      $stmt->execute([
          'username' => $card['username'],
          'card_number' => $card['number']
      ]);
    }

    // return both the card number, and if it was new
    return [
        'number' => $number,
        'new' => $new_entry
    ];
  }

}

?>