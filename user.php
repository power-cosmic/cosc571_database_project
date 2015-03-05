<?php
include_once 'admin/php/common.php';
include_once 'admin/php/displays.php';

session_start();
?>
<!doctype html>
<html>
  <?=createBasicHead('User', ['test.js'])?>
  <body>
    <?=createHeader()?>
    <?=createFooter()?>
  </body>
</html>
