<?php
  include_once 'admin/php/book_info.php';
  include_once 'admin/php/common.php';
  include_once 'admin/php/confirmation_table.php';
  include_once 'admin/php/displays.php';
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
          
            <?php $confirmation=[
                'username' => 'coolguy47',
                'date' => '02/06/1990',
                'time' => '11:20:22'
            ]?>
            
            <?=generate_confirmation_table("Confirmation", null, null, $confirmation)?>
            <div id="buttons" class="box align-right">
              <input type="submit" class="blue button" value="Update">
              <input type="submit" class="green button" value="Checkout">
            </div>
          </form>
        </div>
      </div>
      <?=createFooter()?>
    </div>
  </body>
</html>