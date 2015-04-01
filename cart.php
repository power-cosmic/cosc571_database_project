<?php
include_once 'admin/php/cart.php';
include_once 'admin/php/common.php';
include_once 'admin/php/displays.php';
include_once 'admin/php/book_info.php';

session_start();
?>
<!doctype html>
<html>
  <?=createBasicHead('Cart', 'cart_updater', ['book_table.css'])?>
  <body>
    <div id="container">
      <?=createHeader()?>
      <div class="content">
        <div id="cart" class="centered box">
          <form method="post" action="checkout.php">
            <table id="books-in-cart" class="wide">
              <tr>
                <th class="thin-cell">Remove</th>
                <th>Book Description</th>
                <th class="thin-cell">Qty</th>
                <th class="thin-cell">Price</th>
              </tr>
              
              <?php
                $cart = Cart::get_instance();
                $cart_contents = $cart->get_items();
                
                foreach ($cart_contents as $item) {
                  $book = $item['book'];
                  $cost = $book->price * $item['quantity'];
              ?>
                <tr class="book-row">
                  <td class="book-info">
                    <input type="button" 
                        class="purple button centered-input delete-button" 
                        value="Delete" name="delete <?=$book->isbn?>">
                  </td>
                  <td class="book-info"><?=$book->generateBookInfo()?></td>
                  <td class="book-info">
                    <input type="number" name="quantity <?=$book->isbn?>" 
                        class="quantity-box right-aligned centered-input" 
                        value="<?=$item['quantity']?>">
                  </td>
                  <td class="book-info">
                    <div class="book-cost centered-input">$<?=sprintf("%.2f", $cost)?></div>
                  </td>
                </tr>
              <?php
                }
              ?>

            </table>
            <div id="total" class="box right-aligned">
              Subtotal: $<?=$cart->get_subtotal()?>
            </div>
            <div id="buttons" class="box right-aligned">
              <!-- <input type="submit" class="blue button" value="Update"> -->
              <input type="submit" class="green button" value="Checkout">
            </div>
          </form>
        </div>
      </div>
      <?=createFooter()?>
    </div>
  </body>
</html>
