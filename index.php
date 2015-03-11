<?php
include_once 'admin/php/common.php';
include_once 'admin/php/displays.php';
include_once 'admin/php/connection.php';
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
          <span class="v-align-helper"></span>
          <?php
          //get the top 10 number of sold books
          $book_info = [
              'id' => 1,
              'title' => 'Absolute Java Is The Best Book Around',
              'first_name' => 'Walter',
              'last_name' => 'Savitch',
              'price' => '149.99',
              'quantity' => '2',
              'publisher' => 'Addison-Wesley',
              'isbn' => '978-0132834230',
              'cover' => 'admin/images/icons/cart.jpg'
          ];

          $book = new Book($book_info);

          for ($i = 0; $i < 10; $i++) {
            echo $book->generateBookView();
          }

          ?>
        </div>
        <h2 class="book-view-header">Hot Buys:</h2>
        <div id="recent_picks" class="scrolling-view">
          <span class="v-align-helper"></span>
          <?php
            //get the top 10 most recently purchased books
          ?>
        </div>
        <h2 class="book-view-header">Great Deals:</h2>
        <div id="great_deals" class="scrolling-view">
          <span class="v-align-helper"></span>
          <?php
            //get the top 10 least expensive books
            $sql = "SELECT isbn,title,price,first_name,last_name FROM book,author WHERE book.author_id=author.id GROUP BY price LIMIT 10;";
            $db = open_connection();
            $stmt = $db->prepare($sql);
            $stmt->execute();
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
              $book = new Book($row);
              echo $book->generateBookView();
            }
          ?>
        </div>
      </div>
      <?=createFooter()?>
    </div>
  </body>
</html>
