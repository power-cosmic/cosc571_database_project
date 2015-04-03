<?php
class Customer_inserter {

  private $select_sql = "SELECT username
      FROM customer
      WHERE username=:username;";

  private $insert_sql = "INSERT INTO customer (
          username,
          password,
          email,
          first_name,
          last_name,
          address_id
        ) VALUES (
          :username,
          :password,
          :email,
          :first_name,
          :last_name,
          :address_id
      );";
  
  private $update_sql = 'UPDATE customer SET
          password = :password,
          email = :email,
          first_name = :first_name,
          last_name = :last_name,
          address_id = :address_id
        WHERE username = :username;';

  private $db;

  function __construct($db) {
    $this->db = $db;
  }

  public function does_exist($username) {
    $stmt = $this->db->prepare($this->select_sql);
    $stmt->execute(['username' => $username]);
    if ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
      return true;
    }

    return false;
  }

  public function update($customer) {
    $stmt = $this->db->prepare($this->update_sql);
    $stmt->execute($customer);
    return ['username' => $customer['username']];
  }
  
  public function insert($customer) {
    $stmt = $this->db->prepare($this->insert_sql);
    $stmt->execute($customer);
    return ['username' => $customer['username']];
  }

}

?>