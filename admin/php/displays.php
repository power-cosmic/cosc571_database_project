<?php
session_start();
include_once 'constants.php';

function createHeader($showCart = true, $showLogin = true) {
  $to_return = '<div id="header" class="bar">
        <div class="centered box">
          <div id="title">
            <a class="no-decoration" href="' . $GLOBALS['locations']['home'] . '"><h1>' . $GLOBALS['name']['long'] . '</h1></a>
          </div>
          <div id="user-info">';

  if (!$_SESSION['logged_in']) {
    if ($showLogin) {
      $to_return .= '
            <div id="logInButton">
              <a href="' . $GLOBALS['locations']['login'] . '">log in</a>
            </div>
            <div>
              <a href="' . $GLOBALS['locations']['register'] . '">register</a>
            </div>
            <div>
              <a href="' . $GLOBALS['locations']['cart'] . '">cart</a>
            </div>';
    }
  } else {
    switch($_SESSION['logged_in']) {
      case $GLOBALS['user_status']['admin']:
        $to_return .= '
            <div id="adminLogoutButton">
              <a href="logout.php">logout</a>
            </div>';
        break;
      case $GLOBALS['user_status']['user']:
        $to_return .= '
            <div id="nameAndLogoutButtons">
              <a href="' . $GLOBALS['locations']['home'] . '">logout</a>
              <a href="' . $GLOBALS['locations']['cart'] . '">cart</a>
            </div>';
        break;
      default:
    }
  }

  if ($showCart) {
  }

  $to_return .= '
          </div>
        </div>
      </div>' . "\n";
  return $to_return;
}

function createFooter() {
  $to_return = '<div id="footer" class="bar">
        <div class="centered">
          <div class="thin-box">&copy; 2013-' . date('Y') . '</div> |
          <div class="thin-box"><a href="' . $GLOBALS['locations']['admin'] . '">admin</a></div>
        </div>
      </div>' . "\n";

  return $to_return;
}

?>
