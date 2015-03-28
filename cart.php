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

              <!-- TODO: generate rows from db -->
              <?php
                $cart = Cart::get_instance();
                $cart_contents = $cart->get_items();
                
                $books = [];
                $quantities = [];
                
                
                
                $test_book_data = [
                    'id' => 1,
                    'title' => 'Absolute Java',
                    'author' => 'Walter Savitch',
                    'price' => '149.99',
                    'publisher' => 'Addison-Wesley',
                    'isbn' => '978-0132834230'
                ];
                $books = [new Book($test_book_data), new Book($test_book_data)];
                $quantities = [1, 2];
                $total = 0;
              ?>
              <?php
                $total = 0;
                for ($i = 0; $i < count($books); $i++) {
                  $book = $books[$i];
                  $cost = $book->price * $quantities[$i];
                  $total += $cost;
              ?>
                <tr class="book-row">
                  <td class="book-info">
                    <input type="button" 
                        class="purple button centered-input delete-button" 
                        value="Delete" name="delete <?=$book->isbn?>">
                  </td>
                  <td class="book-info"><?=$book->generateBookInfo()?></td>
                  <td class="book-info">
                    <input type="number" name="quantity" 
                        class="quantity-box right-aligned centered-input" 
                        value="<?=$quantities[$i]?>">
                  </td>
                  <td class="book-info">
                    <div class="book-cost centered-input">$<?=$cost?></div>
                  </td>
                </tr>
              <?php
                }
              ?>

            </table>
            <div id="total" class="box right-aligned">
              Subtotal: $<?=$total?>
            </div>
            <div id="buttons" class="box right-aligned">
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
