<?php
class Login {
  private $username;
  private $user_type;  // customer/admin

  public static function get_instance() {
    if (!isset($_SESSION['login'])) {
      $_SESSION['login'] = new Login();
    }
    return $_SESSION['login'];
  }

  private function __construct() {
    $this->username = null;
    $this->user_type = null;
  }

  public function log_out() {
    $this->username = null;
    $this->user_type = null;
  }

  public function get_username() {
    return $this->username;
  }

  public function get_user_type() {
    return $this->user_type;
  }

  public function is_logged_in() {
    return $this->use_type != null;
  }

  public function customer_login($username, $password) {
    $query = "SELECT username
      FROM customer
      WHERE username=:username
        AND password=PASSWORD(:password);";
    return $this->login($username, $password, $query, 'user');
  }
  
  public function admin_login($username, $password) {
    $query = "SELECT username
      FROM admin
      WHERE username=:username
        AND password=PASSWORD(:password);";
    return $this->login($username, $password, $query, 'admin');
  }
  
  private function login($username, $password, $query, $type) {

    try {
      $db = open_connection();
      $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $stmt = $db->prepare($query);
      $stmt->execute([
        'username' => $username,
        'password' => $password
      ]);
  
      if ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $this->username = $username;
        $this->user_type = $type;
        return true;
      } else {
        return false;
      }
    } catch (PDOException $e) {
      print_r($e);
    }
  }

}

?>