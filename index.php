<?php
include_once 'admin/php/common.php';
include_once 'admin/php/displays.php';
include_once 'admin/php/book_info.php';

session_start();
?>
<!doctype html>
<html>
  <?=createBasicHead('home', null, ['book_view.css'])?>
  <body>
    <div id="container">
      <?=createHeader()?>
      <div class="content centered">
        <?php
          //if logged in, recommended for you/from wishlist
        ?>
        <h2 class="book-view-header">Best Sellers:</h2>
        <div id="top_picks" class="scrolling-view">
          <?php
          //get the top 10 number of sold books
          $book_info = [
              'id' => 1,
              'title' => 'Absolute Java Is The Best Book Around',
              'author' => 'Walter Savitch',
              'price' => '149.99',
              'quantity' => '2',
              'publisher' => 'Addison-Wesley',
              'isbn' => '978-0132834230',
              'cover' => 'admin/images/icons/cart.jpg'
          ];
          
          $book = new Book($book_info);

          echo '<span class="v-align-helper"></span>';
          for ($i = 0; $i < 10; $i++) {
            echo $book->generateBookView();
          }

          ?>
        </div>
        <h2 class="book-view-header">Hot Buys:</h2>
        <div id="recent_picks" class="scrolling-view">
          <?php
            //get the top 10 most recently purchased books
          ?>
        </div>
        <h2 class="book-view-header">Great Deals:</h2>
        <div id="great_deals" class="scrolling-view">
          <?php
            //get the top 10 least expensive books
          ?>
        </div>
      </div>
      <?=createFooter()?>
    </div>
  </body>
</html>
