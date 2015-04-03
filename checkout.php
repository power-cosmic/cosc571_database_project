<?php
include_once 'admin/php/cart.php';
include_once 'admin/php/common.php';
include_once 'admin/php/displays.php';
include_once 'admin/php/book_info.php';
include_once 'admin/php/confirmation_table.php';
include_once 'admin/php/login.php';

session_start();
$_SESSION['previous'] = $GLOBALS['locations']['checkout'];

$login = Login::get_instance();
// redirect if needed
if (!$login->is_logged_in()) {
  header('Location: ' . $GLOBALS['locations']['login']);
}

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
              <input type="submit" class="green button" value="Submit Order">
            </div>
          </form>
        </div>
      </div>
      <?=createFooter()?>
    </div>
  </body>
</html>
