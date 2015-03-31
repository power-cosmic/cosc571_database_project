<?php
include_once 'admin/php/common.php';
include_once 'admin/php/displays.php';
include_once 'admin/php/admin_login.php';
include_once 'admin/php/constants.php';
include_once 'admin/php/connection.php';

session_start();

if ($_POST['username'] == 'admin' && $_POST['password'] == 'admin') {
  $_SESSION['logged_in'] = $GLOBALS['user_status']['admin'];
}

?>
<!doctype html>
<html>
  <?=createBasicHead('Admin')?>
  <body>
    <div id="container">
      <?=createHeader()?>
      <div class="content">

        <?php

        if ($_SESSION['logged_in'] == $GLOBALS['user_status']['admin']) {
            $db = open_connection();
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


          ?>
          <!-- display admin page -->
        <div id="login" class="centered box">
          <p>
            Registered users:
            <?php
            $sql = "SELECT count(username)
                    FROM customer;";
            $stmt = $db->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            echo $result['count(username)'];
            ?>
          </p>
          <table id="books-by-category">
            <tr>
              <th>Category</th>
              <th>Number of books</th>
            </tr>
            <?php
            $sql = "SELECT count(book.isbn),name
                    FROM book,genre,book_genre
                    WHERE book.isbn=book_genre.isbn
                      AND genre.id=book_genre.genre_id
                    GROUP BY name
                    ORDER BY count(book.isbn) DESC;";
            $stmt = $db->prepare($sql);
            $stmt->execute();
            while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
            ?>
            <tr>
              <td><?= $result['name'] ?></td>
              <td><?= $result['count(book.isbn)'] ?></td>
            </tr>
            <?php
            }
            ?>
          </table>
          <br>
          <table id="average-sales-by-month">
            <tr>
              <th>Month</th>
              <th>Average Monthly Sales</th>
            </tr>
            <!-- TODO: generate this w/ php -->
            <tr>
              <td>January</td>
              <td>$555</td>
            </tr>
            <tr>
              <td>February</td>
              <td>$234</td>
            </tr>
          </table>
          <p><a href="book_records.php">View Book Records</a></p>
        </div>

        <?php
        } else {
          echo generate_admin_login();
        }
        ?>

      </div>
      <?=createFooter()?>
    </div>
  </body>
</html>
