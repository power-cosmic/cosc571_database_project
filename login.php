<?php
include_once 'admin/php/common.php';
include_once 'admin/php/displays.php';

session_start();
?>
<!doctype html>
<html>
  <?=createBasicHead('Login')?>
  <body>
    <div id="container">
      <?=createHeader(true, false)?>
      <div class="content">
        <div id="login" class="centered box">
          <form method="post" action="<?=$_SERVER['PHP_SELF']?>">
            <input type="text" name="username" id="username" placeholder="username">
            <input type="password" name="password" id="password" placeholder="password">
            <input type="submit" value="login" class="blue button">
          </form>
        </div>
      </div>
      <?=createFooter()?>
    </div>
  </body>
</html>
