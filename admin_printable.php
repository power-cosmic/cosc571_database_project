<?php
include_once 'admin/php/common.php';
include_once 'admin/php/connection.php';
include_once 'admin/php/displays.php';
include_once 'admin/php/admin_login.php';
include_once 'admin/php/constants.php';
include_once 'admin/php/login.php';

session_start();

if (!Login::get_instance()->get_user_type() == $GLOBALS['user_status']['admin']) {
  header('Location: ' . $project_root . '/admin.php');
  die();
}
?>
<!doctype html>
<html>
  <head>
    <style>
      table: {
        border-collapse: collapse;
      }
      table, td, th, tr {
        border: 1px solid black;
        border-spacing: 0px;
      }
    </style>
  </head>
  <body>
    <div id="container">
      <div class="content">

        <?php if (Login::get_instance()->get_user_type() == $GLOBALS['user_status']['admin']) {
          $db = open_connection();
          $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        ?>
        
        <!-- display admin page -->
        <div id="login" class="centered box">
          <h1>Admin Summary</h1>
          <p>
            Registered users:
            <?php
              $sql = "SELECT count(username) AS count
                FROM customer;";
              $stmt = $db->prepare($sql);
              $stmt->execute();
              $result = $stmt->fetch(PDO::FETCH_ASSOC);
              echo $result['count'];
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
          <br>
          <table id="books">
            <tr>
              <th>Book</th>
              <th>Number of reviews</th>
            </tr>
            
            <?php
            $query = 'SELECT title, COUNT(reveiw.book_isbn) AS reviews
              FROM book
              LEFT JOIN reveiw
              ON book.isbn = reveiw.book_isbn
              GROUP BY book.isbn';
                        
            $stmt = $db->prepare($query);
            $stmt->execute();
            
            while($result = $stmt->fetch(PDO::FETCH_ASSOC)) { 
            ?>
              <tr>
                <td><?=$result['title']?></td>
                <td><?=intval($result['reviews'])?></td>
              </tr>
            <?php
            }
            ?>
            
          </table>
          <br>
        </div>

        <?php
        } else {
          echo generate_admin_login();
        }
        ?>

      </div>
    </div>
  </body>
</html>