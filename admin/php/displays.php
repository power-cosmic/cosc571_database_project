<?php
session_start();
include_once 'constants.php';

function createHeader($showCart = true, $showLogin = true, $showSearch = true) {
  $to_return = '<div id="header-replacer" class="collapsed bar"></div>
      <div id="header" class="bar">
        <div class="centered box">
          <div id="title">
            <a class="no-decoration" href="' . $GLOBALS['locations']['home'] . '"><h1>' . $GLOBALS['name']['long'] . '</h1></a>
          </div>
          <div id="user-info">';

  if (!isset($_SESSION['login'])) {
    if ($showLogin) {
      $to_return .= '
            <div id="logInButton">
              <a href="' . $GLOBALS['locations']['login'] . '" class="glow-link">log in</a> |
              <a href="' . $GLOBALS['locations']['register'] . '" class="glow-link">register</a> |
              <a href="' . $GLOBALS['locations']['cart'] . '" class="glow-link">cart</a>
            </div>';
    }
  } else {
    switch($_SESSION['login']->get_user_type()) {
      case $GLOBALS['user_status']['admin']:
        $to_return .= '
            <div id="adminLogoutButton">
              <a href="' . $GLOBALS['locations']['logout'] . '" class="glow-link">logout</a>
            </div>';
        break;
      case $GLOBALS['user_status']['user']:
        $to_return .= '
            <div id="nameAndLogoutButtons">
              <a href="' . $GLOBALS['locations']['logout'] . '" class="glow-link">logout</a> |
              <a href="' . $GLOBALS['locations']['profile'] . '" class="glow-link">profile</a> |
              <a href="' . $GLOBALS['locations']['cart'] . '" class="glow-link">cart</a>
            </div>';
        break;
      default:
      $to_return .= '
            <div id="logInButton">
              <a href="' . $GLOBALS['locations']['login'] . '" class="glow-link">log in</a> |
              <a href="' . $GLOBALS['locations']['register'] . '" class="glow-link">register</a> |
              <a href="' . $GLOBALS['locations']['cart'] . '" class="glow-link">cart</a>
            </div>';
    }
  }

  if ($showCart) {
  }

  $to_return .= '
          </div>
        </div>';
  if ($showSearch) {
    $to_return .= '
        <div style="position:absolute;bottom:10px;text-align:center;width:100%;">
          <form id="the-search" action="' . $GLOBALS['locations']['search'] . '" method="GET">
            <div id="short-name">
              <a class="no-decoration" href="' . $GLOBALS['locations']['home'] . '">'
                  . $GLOBALS['name']['short'] .'</a>
            </div>
            <input type="text" name="query" placeholder="search query" id="search-bar"
                value="' . $_GET['query'] . '">
            <input type="submit" value="search" class="green button">
            <div id="simple-cart">
              <a class="no-decoration" href="' . $GLOBALS['locations']['cart'] . '">
                &lfloor;<span class="cart-update-num">'
                . (isset($_SESSION['cart']) ? $_SESSION['cart']->num_in_cart() : '0')
                . '</span>&rfloor;
              </a>
            </div>
          </form>
        </div>';
  }

  $to_return .= '
      </div>' . "\n";
  return $to_return;
}

function createFooter() {
  date_default_timezone_set('America/Detroit');

  $to_return = '<div id="footer" class="bar" style="position:fixed;">
        <div class="centered" id="footer-data">
          <div class="thin-box">&copy; 2013-' . date('Y') . '</div> |
          <div class="thin-box"><a href="' . $GLOBALS['locations']['admin'] . '">admin</a></div>
        </div>
      </div>' . "\n";

  return $to_return;
}

?>
