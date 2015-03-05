<?php
include_once 'admin/php/common.php';
include_once 'admin/php/displays.php';
include_once 'admin/php/constants.php';
include_once 'admin/php/profile.php';
include_once 'admin/php/us_state_dropdown.php';

session_start();

$username = ($_SESSION['username']) ? $_SESSION['username'] : 'unknown';
?>
<!doctype html>
<html>
  <?=createBasicHead('Update')?>
  <body>
    <div id="container">
      <?=createHeader(true, false)?>
      <div class="content">
        <div id="login" class="centered box">
        <?=createProfileForm($username)?>
        </div>
      </div>
      <?=createFooter()?>
    </div>
  </body>
</html>