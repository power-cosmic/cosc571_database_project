<?php
  include_once 'admin/php/common.php';
  include_once 'admin/php/displays.php';
?>
<!doctype html>
<html>
  <?=createBasicHead('3-B | Search Results')?>
  <body>
    <?=createHeader()?>
    <div id="search">
      <form method="get" action="<?=$_SERVER['PHP_SELF']?>">
        <input type="text" id="query" placeholder="search query">
        <input type="submit" value="search">
      </form>
      </div>
    <?=createFooter()?>
  </body>
</html>
