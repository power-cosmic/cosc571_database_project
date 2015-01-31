<?php
session_start ();
include_once 'constants.php';

function createHeader($showCart = true, $showLogin = true) {
  $to_return = '<div id="header" class="bar">
      <div class="box">
      <div><h1>3b</h1></div>';

  if (! $_SESSION ['logged_in']) {
    if ($showLogin) {
      $to_return .= '<div id="logInButton">log in</div>';
    }
  } else {
    switch ($_SESSION ['logged_in']) {
      case $GLOBALS ['user_status'] ['admin'] :
        $to_return .= '<div id="adminLogoutButton">
            <a href="logout.php">logout</a>
            </div>';
        break;
      case $GLOBALS ['user_status'] ['user'] :
        $to_return .= '<div id="nameAndLogoutButtons>Hi</div>';
        break;
      default :
    }
  }

  if ($showCart) {
  }

  $to_return .= '</div></div>';
  return $to_return;
}

function createFooter() {
  $to_return = '<div id="footer" class="bar">
      <div class="box">&copy; 2013-'.date('Y').'</div>
      </div>';
  
  
  
  return $to_return;
}


?>