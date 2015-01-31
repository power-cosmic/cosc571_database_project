<?php
include_once 'admin/php/common.php';
include_once 'admin/php/displays.php';
?>
<!doctype html>
<html>
  <?=createBasicHead('3-B - Login')?>
  <body>
    <?=createHeader()?>
    <div id="login">

    <form method="post">
      <input type="text" name="username" id="username"
        placeholder="username"> <input type="password" name="password"
        id="password" placeholder="password"> <input type="submit"
        value="login">
    </form>

  </div>
    <?=createFooter()?>
  </body>
</html>