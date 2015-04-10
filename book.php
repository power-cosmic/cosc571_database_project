<?php
include_once 'admin/php/common.php';
include_once 'admin/php/connection.php';
include_once 'admin/php/displays.php';
include_once 'admin/php/constants.php';
include_once 'admin/php/login.php';
include_once 'admin/php/review_info.php';

session_start();

?>
<!doctype html>
<html>
  <?php
    $cart = Cart::get_instance();

    $db = open_connection();
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT isbn,title,price,first_name,last_name,cover,publisher.name as publisher,description
                      FROM book,author,publisher
                      WHERE book.author_id=author.id
                            AND publisher_id=publisher.id
                            AND book.isbn=:isbn;";
    $stmt = $db->prepare($sql);
    $stmt->execute([
        'isbn' => $_GET['isbn']
    ]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    echo createBasicHead($result['title'], 'wishlist_updater', ['book.css']);
    $book = new Book($result);
  ?>
  <body>
  <div id="container">
      <?=createHeader()?>
      <div class="content centered" style="position: relative;">
      <img src=<?=$book->get_cover($book->cover)?> />
      <div id="options">
        <p id="description"><?=$book->description?></p>
        <table>
          <tr>
            <th>Title</th><td><?=$book->title?></td>
          </tr>
          <tr>
            <th>Author</th><td><?=($book->first_name . ' ' . $book->last_name)?></td>
          </tr>
          <tr>
            <th>Price</th><td>$<?=$book->price?></td>
          </tr>
          <tr>
            <th>Publisher</th><td><?=$book->publisher?></td>
          </tr>
          <?php
          $sql = "SELECT genre.name AS name
                  FROM book_genre,genre
                  WHERE book_genre.genre_id=genre.id
                    AND book_genre.isbn=:isbn;";
          $stmt = $db->prepare($sql);
          $stmt->execute([
              'isbn' => $book->isbn
          ]);
          $genres = [];
          while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
            array_push($genres, $result['name']);
          }
          ?>
          <tr>
            <th>Genre</th><td><?=implode(', ', $genres)?></td>
          </tr>
        </table>
        <div style="margin-top:20px;">
          <input style="float: left;" type="button" class="green button centered-input add-button"
            value="Add to cart" name="add <?=$book->isbn?>" <?=$cart->contains($book)? 'disabled':''?> />
          <input style="float: left;" type="button" class="purple button centered-input"
            value="Reviews" onclick="window.location.href='review.php?isbn=<?=$book->isbn?>'" />

          <?php if ($_SESSION && $_SESSION['login'] && $_SESSION['login']->get_user_type() === 'user') { ?>
          <input style="float: left;" type="button" class="red button centered-input wishlist-button"
            value="Add to wishlist" name="wish <?=$book->isbn?>"
            <?php

            $sql = "SELECT count(*) as num
                    FROM wishlist
                    WHERE customer_username=:username
                      AND book_isbn=:isbn;";
            $stmt = $db->prepare($sql);
            $stmt->execute([
                'isbn' => $book->isbn,
                'username' => $_SESSION['login']->get_username()
            ]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($result['num'] > 0) {
              echo ' disabled="disabled" ';
            }

            ?>
             />
          <?php }?>
        </div>
      </div>
        <?php

        ?>
        <h3 style="text-align:left;">
          Reviews for <?= $book->title?>:
        </h3>
        <table id="reviews" class="wide" style="margin-bottom:20px;">
          <tr>
            <th class="thin-cell">Username</th>
            <th>Review</th>
            <th class="thin-cell">Rating</th>
          </tr>
          <?php
            $sql = "SELECT customer_username AS username,rating,content,submit_time
                        FROM review
                        WHERE book_isbn='" . $_GET['isbn'] . "'
                        ORDER BY submit_time DESC";
            $stmt = $db->prepare($sql);
            $stmt->execute();

            while($review = $stmt->fetch(PDO::FETCH_ASSOC)) {
              echo generateReview($review);
            }
          ?>
        </table>
      </div>
      <?=createFooter()?>
    </div>
</body>
</html>
