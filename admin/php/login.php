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
    $db = open_connection();
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $db->prepare("SELECT username
        FROM customer
        WHERE username=:username
          AND password=PASSWORD(:password);"
    );

    $stmt->execute([
      'username' => $username,
      'password' => $password
    ]);

    if ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
      $this->username = $username;
      $this->user_type = 'user';
      return true;
    } else {
      return false;
    }
  }

}

?>