<?php
include_once 'admin/php/common.php';
include_once 'admin/php/displays.php';

function generate_admin_login() {
  return '
  <div id="admin-login" class="centered box">
    <form method="post" action="'.$GLOBAL['locations']['admin'].'">
        <input type="text" name="username" id="username" placeholder="username">
        <input type="password" name="password" id="password" placeholder="password">
        <input type="submit" value="login" class="green button">
      </form>
  </div>';
}

?>