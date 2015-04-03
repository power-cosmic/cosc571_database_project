<?php
include_once 'admin/php/common.php';
include_once 'admin/php/displays.php';
include_once 'admin/php/constants.php';
include_once 'admin/php/connection.php';
include_once 'admin/php/review_info.php';

session_start();

if (isset($_POST['rating'])) {
  $values = array(
      'customer_username' => $_SESSION['login']->get_username(),
      'book_isbn' => $_GET['isbn'],
      'rating' => $_POST['rating'],
      'content' => $_POST['content']
  );

  $db = open_connection();
  try {
  $sql = "INSERT INTO review
            (book_isbn, customer_username, rating, content)
            VALUES
            (:book_isbn, :customer_username, :rating, :content)";
  $stmt = $db->prepare($sql);
  $stmt->execute($values);
  } catch (PDOException $e) {

  }
}
?>
<!doctype html>
<html>
  <?=createBasicHead('Review')?>
  <body>
    <div id="container">
      <?=createHeader()?>
      <div id="content">
        <?php
            if (!$db) {
              $db = open_connection();
            }
            $sql = "SELECT title, CONCAT(first_name, ' ', last_name) as author
                      FROM book,author
                      WHERE isbn='" . $_GET['isbn'] . "' AND book.author_id=author.id";
            $stmt = $db->prepare($sql);
            $stmt->execute();
            $book = $stmt->fetch(PDO::FETCH_ASSOC);
            ?>
            <div id="cart" class="centered box">
              <div style="position:relative;" class="wide">
                <h3 style="text-align:left;">Reviews for <?= $book['title']?> by <?= $book['author']?></h3>
                <?php
                if ($_SESSION['login']) {
                ?>
                <input type="button" style="position:absolute;right:0px;top:0px;"
                    class="purple button centered-input"
                    value="Write review" name="review <?=$book->isbn?>" onclick="showReviewForm(this);">

                    <script>
                    var numStarsSelected = 0;

                    function setStars(num) {
                    	  var stars = document.getElementsByClassName('stars');
                    	  var limit = stars.length;
                    	  for (var i = 0; i < limit; i++) {
                        	  if (i < num) {
                        		  stars[i].innerHTML = '&#x2605;';
                        	  } else {
                        		  stars[i].innerHTML = '&#x2606;';
                        	  }
                    	  }
                    }
                    function assignStarValue(num) {
                    	  setStars(num);
                    	  numStarsSelected = num;
                    	  document.getElementById('rating-elem').value = num;
                    }
                    function showReviewForm(elem) {
                    	  document.getElementById('review-form').hidden = '';
                    	  elem.disabled = 'disabled';
                    }
                    </script>
                <form id="review-form" action="<?= ($_SERVER['PHP_SELF'] . '?isbn=' . $_GET['isbn']) ?>" method="post" hidden="hidden">
                  <div style="width:80%;cursor:pointer;" class="centered" onmouseout="setStars(numStarsSelected);">
                    Rating:
                    <input id="rating-elem" hidden="hidden" value="0" name="rating" />
                    <input hidden="hidden" value="<?= $_GET['isbn'] ?>" name="isbn" />
                    <span class="stars" onmouseover="setStars(1);" onclick="assignStarValue(1);"></span>
                    <span class="stars" onmouseover="setStars(2);" onclick="assignStarValue(2);"></span>
                    <span class="stars" onmouseover="setStars(3);" onclick="assignStarValue(3);"></span>
                    <span class="stars" onmouseover="setStars(4);" onclick="assignStarValue(4);"></span>
                    <span class="stars" onmouseover="setStars(5);" onclick="assignStarValue(5);"></span>

                    <script>setStars(0);</script>
                  </div>
                  <textarea style="position:relative;width:80%;display:block;margin:auto;margin-bottom:5px;"
                      rows="4" placeholder="Write your review here" name="content"></textarea>
                  <input type="submit" class="green button centered-input"
                      style="display:block;float:right;clear:both;margin-bottom:5px;">
                </form>
                <?php
                }
                ?>
              </div>

            <?php

            $sql = "SELECT customer_username AS username,rating,content,submit_time
                      FROM review
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
                if ($_SESSION['login']) {
            ?>
            <div class="wide" style="clear:both;">Oops, there's no reviews for this book! Why don't you write one?</div>

            <?php
                } else {
            ?>
            <div class="wide" style="clear:both;">This book hasn't been reviewed yet.</div>
            <?php
                }
            }
            ?>
            </div>
      </div>
      <?=createFooter()?>
    </div>
  </body>
</html>
