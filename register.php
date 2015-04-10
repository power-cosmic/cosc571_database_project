<?php
include_once 'admin/php/common.php';
include_once 'admin/php/displays.php';
include_once 'admin/php/constants.php';
include_once 'admin/php/profile.php';
include_once 'admin/php/us_state_dropdown.php';

session_start();

$_SESSION['previous'] = $_SERVER['PHP_SELF'];

?>
<!doctype html>
<html>
  <?=createBasicHead('Register', 'registerCheck')?>
  <body>
    <div id="container">
      <?=createHeader(true, false, false)?>
      <div class="content">
        <div id="login" class="centered box">
        <?=createProfileForm()?>
        </div>
      </div>
      <?=createFooter()?>
    </div>
  </body>
</html>
