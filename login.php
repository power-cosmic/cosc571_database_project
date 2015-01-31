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
        <label for="username">username</label>
        <input type="text" name="username" id="username" placeholder="username">
        <br>
        
        <label for="password">password</label>
        <input type="password" name="password" id="password">
        <br>
        
        <input type="submit" value="login">
      </form>
      
    </div>
    <?=createFooter()?>
  </body>
</html>