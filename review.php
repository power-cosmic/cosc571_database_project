<?php
include_once 'admin/php/common.php';
include_once 'admin/php/displays.php';
include_once 'admin/php/constants.php';
include_once 'admin/php/connection.php';
include_once 'admin/php/review_info.php';

session_start();
?>
<!doctype html>
<html>
  <?=createBasicHead('Review')?>
  <body>
    <div id="container">
      <?=createHeader()?>
      <div id="content">
        <?php
            $db = open_connection();
            $sql = "SELECT title, CONCAT(first_name, ' ', last_name) as author
                      FROM book,author
                      WHERE isbn='" . $_GET['isbn'] . "' AND book.author_id=author.id";
            $stmt = $db->prepare($sql);
            $stmt->execute();
            $book = $stmt->fetch(PDO::FETCH_ASSOC);
            ?>
            <div id="cart" class="centered box">
              <div style="position:relative">
                <h3>Reviews for <?= $book['title']?> by <?= $book['author']?></h3>
                <input type="submit" style="position:absolute;right:0px;top:0px;"
                    class="purple button centered-input"
                    value="Write review" name="review <?=$book->isbn?>">
              </div>

            <?php

            $sql = "SELECT customer_username AS username,rating,content,submit_time
                      FROM reveiw
                      WHERE book_isbn='" . $_GET['isbn'] . "'
                      ORDER BY submit_time DESC";
            $stmt = $db->prepare($sql);
            $stmt->execute();

            if ($count = $stmt->rowCount()) {
            ?>

              <table id="reviews" class="wide">
                <tr>
                  <th class="thin-cell">Username</th>
                  <th>Review</th>
                  <th class="thin-cell">Rating</th>
                </tr>

                <?php
                  while($review = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo generateReview($review);
                  }
                ?>
              </table>
            <?php
            } else {
            ?>
              <header>Oops, there's no reviews for this book! Why don't you write one?!</header>
            <?php
            }
            ?>
            </div>
      </div>
      <?=createFooter()?>
    </div>
  </body>
</html>
