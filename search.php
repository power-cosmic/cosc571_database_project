<?php
include_once 'admin/php/common.php';
include_once 'admin/php/displays.php';
?>
<!doctype html>
<html>
  <?=createBasicHead('3-B | Search Results')?>
  <body>
    <?=createHeader()?>

    <div class="content">
      <div id="search" class="centered box">
  
        <form method="get" action="<?=$_SERVER['PHP_SELF']?>">
          <input type="text" id="query" placeholder="search query">
          <input type="submit" value="search" class="green button">
        </form>
  
      </div>
    </div>
    <?=createFooter()?>
  </body>
</html>
