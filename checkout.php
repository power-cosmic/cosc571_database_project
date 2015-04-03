<?php
include_once 'admin/php/cart.php';
include_once 'admin/php/common.php';
include_once 'admin/php/displays.php';
include_once 'admin/php/book_info.php';
include_once 'admin/php/confirmation_table.php';
include_once 'admin/php/login.php';

session_start();
?>
<!doctype html>
<html>
  <?=createBasicHead('Checkout', 'checkout', ['book_table.css'])?>
  <body>
    <div id="container">
      <?=createHeader()?>
      <div class="content">
        <div id="cart" class="centered box">
          <form method="post" action="confirmation.php">
            <?=generate_confirmation_table("Checkout", null, null, null)?>
            <div id="buttons" class="box align-right">
              <!-- <input type="submit" class="purple button" value="Edit Cart"> -->
              <input type="submit" class="green button" value="Submit Order" style="top:-50px;right:50px;position:absolute;">
            </div>
          </form>
        </div>
      </div>
      <?=createFooter()?>
    </div>
  </body>
</html>
