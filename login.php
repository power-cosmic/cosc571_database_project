<?php
include_once 'admin/php/common.php';
include_once 'admin/php/displays.php';
?>
<!doctype html>
<html>
  <?=createBasicHead('3-B | Login')?>
  <body>
    <div id="container">
      <?=createHeader()?>

      <div class="content">
        <div id="login" class="centered box">
  
          <form method="post" action="<?=$_SERVER['PHP_SELF']?>">
            <input type="text" name="username" id="username"
              placeholder="username"> <input type="password"
              name="password" id="password" placeholder="password"> <input
              type="submit" value="login" class="blue button">
          </form>
        </div>
    </div>
  </div>
</body>
</html>
