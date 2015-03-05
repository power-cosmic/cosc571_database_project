<?php
include_once 'admin/php/common.php';
include_once 'admin/php/displays.php';
include_once 'admin/php/book_info.php';
include_once 'admin/php/confirmation_table.php';

session_start();
?>
<!doctype html>
<html>
  <?=createBasicHead('Confirmation', null, ['book_table.css'])?>
  <body>
    <div id="container">
      <?=createHeader()?>
      <div class="content">
        <div id="cart" class="centered box">
          <form method="post" action="<?=$_SERVER['PHP_SELF']?>">

            <?php
              $confirmation=[
                'username' => 'coolguy47',
                'date' => '02/06/1990',
                'time' => '11:20:22'
              ]
            ?>

            <?=generate_confirmation_table("Confirmation", null, null, $confirmation)?>
          </form>
        </div>
      </div>
      <?=createFooter()?>
    </div>
  </body>
</html>