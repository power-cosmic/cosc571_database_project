<?php
class Login {
  private $username;
  private $first_name;
  private $last_name;
  private $user_type;  // customer/admin
  public $primary_address;
  private $addresses;

  public static function get_instance() {
    if (!isset($_SESSION['login'])) {
      $_SESSION['login'] = new Login();
    }
    return $_SESSION['login'];
  }

  private function __construct() {
    $this->username = null;
    $this->user_type = null;
    $this->first_name = null;
    $this->last_name = null;
    $this->primary_address = null;
    $this->addresses = [];
  }

  public function log_out() {
    $this->username = null;
    $this->user_type = null;
    $this->primary_address = null;
    $this->addresses = null;
  }

  public function get_username() {
    return $this->username;
  }

  public function get_user_type() {
    return $this->user_type;
  }

  public function get_primary_address() {
    return $this->primary_address;
  }
  
  public function get_first_name() {
    return $this->first_name;
  }
  
  public function get_last_name() {
    return $this->last_name;
  }
  
  /*public function get_addresses() {
    return $this->addresses;
  }*/
  
  public function is_logged_in() {
    return $this->use_type != null;
  }

  public function customer_login($username, $password) {
    $query = "SELECT username, first_name, last_name, address_id
      FROM customer
      WHERE username=:username
        AND password=PASSWORD(:password);";
    $output = $this->login($query,
        [
          'username' => $username,
          'password' => $password
        ], 
        'user');

    $this->get_addresses();
    $this->first_name = $output['first_name'];
    $this->last_name = $output['last_name'];
    
    return $output? true: false;
  }
  
  public function admin_login($username, $password) {
    $query = "SELECT username
      FROM admin
      WHERE username=:username
        AND password=PASSWORD(:password);";
    $login = $this->login($query,
        [
          'username' => $username,
          'password' => $password
        ],
        'admin');
    
    return $login ? true : false;
  }
  
  private function get_addresses() {
    
    $db = open_connection();
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $this->addresses = [];
    $address_query = "SELECT street_address, city, state, zip
        FROM address, customer_address
        WHERE address.id = customer_address.address_id
          AND customer_address.username = :username;";
    $stmt = $db->prepare($address_query);
    $stmt->execute(['username' => $this->username]);
    
    while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
      array_push($this->addresses, $result);
    }
    
    // get primary address
    $address_query = "SELECT street_address, city, state, zip
        FROM address, customer
        WHERE address.id = customer.address_id
          AND customer.username = :username;";
    $stmt = $db->prepare($address_query);
    $stmt->execute(['username' => $this->username]);
    
    $this->primary_address = 'hello';
    if ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
      $this->primary_address = [
          'street_address' => $result['street_address'],
          'city' => $result['city'],
          'state' => $result['state'],
          'zip' => $result['zip']
      ];
    }
  }
  
  private function login($query, $parameters, $type) {

    try {
      $db = open_connection();
      $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $stmt = $db->prepare($query);
      $stmt->execute($parameters);
  
      if ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $this->username = $parameters['username'];
        $this->user_type = $type;
        return $result;
      } else {
        return null;
      }
    } catch (PDOException $e) {
      print_r($e);
    }
  }

}

?>