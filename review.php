<?php
include_once 'admin/php/common.php';
include_once 'admin/php/displays.php';
include_once 'admin/php/constants.php';
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
          if ($_GET['id']) {
            $review = [
              'customer_id' => 1,
              'book_id'=> 1,
              'rating' => 4,
              'text' => 'This book is definitely my favorite book ever!'
            ];
            $test_book = [
              'id' => 1,
              'title' => 'Absolute Java',
              'author' => 'Walter Savitch',
              'price' => '149.99',
              'quantity' => '2',
              'publisher' => 'Addison-Wesley',
              'isbn' => '978-0132834230'
            ];
            $user = [
              'customer_id' => 1,
              'username' => 'coolguy49',
              'first_name' => 'Luke',
              'last_name' => 'Skywalker',
              'address' => '48 Williams St.',
              'city' => 'Tatooine',
              'state' => 'MI',
              'zip' => '48197',
              'card_type' => 'VISA',
              'card_number' => '1111222233334444',
              'card_expiration' => '04/16'
            ];
            ?>
            <div id="cart" class="centered box">
              <table id="reviews" class="wide">
                <tr>
                  <th class="thin-cell">Username</th>
                  <th>Review</th>
                  <th class="thin-cell">Rating</th>
                </tr>
                <tr>
                  <td class="book-info"><?=$user['username']?></td>
                  <td class="book-info"><?=$review['text']?></td>
                  <td class="book-info"><div class="centered-input"><?=generateReviewRating($review)?></div></td>
                </tr>
              </table>
            </div>
            <?php
          } else {

          }
        ?>
      </div>
      <?=createFooter()?>
    </div>
  </body>
</html>
