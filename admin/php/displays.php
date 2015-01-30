<?php
session_start ();
include_once 'constants.php';

function createHeader($showCart = true, $showLogin = true) {
  $toReturn = '<div id="header" class="box">
      <div><h1>3b</h1></div>';

  if (! $_SESSION ['logged_in']) {
    if ($showLogin) {
      $toReturn .= '<div id="logInButton">log in</div>';
    }
  } else {
    switch ($_SESSION ['logged_in']) {
      case $GLOBALS ['user_status'] ['admin'] :
        $toReturn .= '<div id="adminLogoutButton">
            <a href="logout.php">logout</a>
            </div>';
        break;
      case $GLOBALS ['user_status'] ['user'] :
        $toReturn .= '<div id="nameAndLogoutButtons>Hi</div>';
        break;
      default :
    }
  }

  if ($showCart) {
  }

  $toReturn .= '</div>';
  return $toReturn;
}

function createFooter() {
  
}


?>