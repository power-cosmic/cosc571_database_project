<?php
include_once 'admin/php/common.php';
include_once 'admin/php/displays.php';
?>
<!doctype html>
<html>
  <?=createBasicHead('3-B - Login')?>
  <body>
  <div id="container">
    <?=createHeader()?>
    <div class="content">
      <div id="login" class="centered box">

        <form method="post">
          <input type="text" name="username" id="username" placeholder="username"> <input type="password"
            name="password" id="password" placeholder="password"> <input
            type="submit" value="login" class="blue button">
        </form>
        <br>
        <a href="login.php" class="green big-button">shop</a>
        <a href="login.php" class="blue big-button">buy</a>
        <a href="login.php" class="purple big-button">explore</a>
      </div>
    </div>
    <?=createFooter()?>
    </div>
</body>
</html>