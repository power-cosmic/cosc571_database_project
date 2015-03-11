<?php
include_once 'admin/php/common.php';
include_once 'admin/php/displays.php';
include_once 'admin/php/connection.php';
include_once 'admin/php/book_info.php';

session_start();
?>
<!doctype html>
<html>
  <?=createBasicHead('Search Results', 'search', ['book_table.css'])?>
  <body>

    <div id="container">
      <?=createHeader()?>
      <div class="content">
      <div id="search" class="centered box">

        <br>

        <?php $search_id = "the-search"?>

        <div id="search-criteria-box">
          <h3>Search Criteria</h3>
          <input type="checkbox" name="criteria[title]" value="title" id="criteria-title" form="<?=$search_id?>" checked>
          <label for="criteria-title">Title</label>
          <input type="checkbox" name="criteria[author]" value="author" id="criteria-author" form="<?=$search_id?>">
          <label for="criteria-author">Author</label>
          <input type="checkbox" name="criteria[publisher]" value="publisher" id="criteria-publisher" form="<?=$search_id?>">
          <label for="criteria-publisher">Publisher</label>
          <input type="checkbox" name="criteria[isbn]" value="isbn" id="criteria-isbn" form="<?=$search_id?>">
          <label for="criteria-isbn">ISBN</label>
        </div>
        <div id="search-category-box">
          <h3>Categories</h3>
          <input type="button" id="toggle-category-button" class="purple button" value="Select all">
          <!-- TODO: generate these from database -->
          <?php
          $sql = "SELECT name FROM genre;";
          $db = open_connection();
          $stmt = $db->prepare($sql);
          $stmt->execute();
          $category_num = 0;
          while($genre = $stmt->fetch(PDO::FETCH_ASSOC)) {
          ?>

          <input type="checkbox" name="category[<?=$category_num++?>]"
              value="<?=$genre['name']?>" id="category-<?=str_replace(' ', '_', $genre['name'])?>"
              form="<?=$search_id?>"
              <?php
                foreach ($_GET['category'] as $checked_genre) {
                  if ($genre['name'] == $checked_genre) {
                     echo ' checked="checked"';
                     break;
                  }
                }
              ?>>
          <label for="category-<?=str_replace(' ', '_', $genre['name'])?>"><?=$genre['name']?></label>
          <?php
          }
          ?>
        </div>

        <!-- </form> -->
      </div>

      <?php if ($_GET['query']) { ?>
        <div id="search-results" class="centered box">
          <table id="books-in-cart" class="wide">
            <tr>
              <th colspan="3">Results</th>
            </tr>

            <?php
              $db = open_connection();
              $sql = "SELECT title, price, isbn, description,
                              publisher.name as publisher, genre.name as genre,
                              first_name, last_name
                      FROM book,author,publisher,genre
                      WHERE author_id=author.id
                            AND publisher_id=publisher.id
                            AND genre_id=genre.id";

              //              AND " . $_GET['criteria'] . " LIKE '%" . $_GET['query'] . "%'
              //        LIMIT 10;";
              if ($_GET['criteria']) {
                $sql .= " AND (";
                $at_least_one = false;
                if ($_GET['criteria']['author']) {
                  $sql .= "first_name LIKE '%" . $_GET['query'] . "%'";
                  $sql .= " OR last_name LIKE '%" . $_GET['query'] . "%'";

                  $at_least_one = true;
                }
                if ($_GET['criteria']['title']) {
                  if ($at_least_one) {
                    $sql .= " OR ";
                  }
                  $sql .= "title LIKE '%" . $_GET['query'] . "%'";

                  $at_least_one = true;
                }
                if ($_GET['criteria']['publisher']) {
                  if ($at_least_one) {
                    $sql .= " OR ";
                  }
                  $sql .= "publisher.name LIKE '%" . $_GET['query'] . "%'";

                  $at_least_one = true;
                }
                if ($_GET['criteria']['isbn']) {
                  if ($at_least_one) {
                    $sql .= " OR ";
                  }
                  $sql .= "isbn LIKE '%" . $_GET['query'] . "%'";

                  $at_least_one = true;
                }
                $sql .= ")";
              } else {
                $sql .= " AND (";
                $sql .= "title LIKE '%" . $_GET['query'] . "%'";
                $sql .= ")";

              }
              if ($_GET['category']) {
                $sql .= " AND (";
                $sql .= "genre.name = '" . array_pop($_GET['category']) . "'";
                foreach ($_GET['category'] as $selected_genre) {
                  $sql .= " OR genre.name = '" . $selected_genre . "'";
                }
                $sql .= ")";
              }
              //echo "<tr><td colspan='3'>$sql</td></tr>";
              $stmt = $db->prepare($sql);
              $stmt->execute();
              while($book_data = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $book = new Book($book_data);
            ?>
            <tr>
              <td class="book-info">
                <input type="button" class="green button centered-input"
                    value="Add to cart" name="add <?=$book->isbn?>">
              </td>
                <td class="book-info">
                  <input type="button" class="blue button centered-input"
                    value="Reviews" onclick="window.location.href='review.php?id=<?=$book->isbn?>'" />
                </td>
              <td class="book-info"><?=$book->generateBookInfo()?></td>
            </tr>
            <?php
              }
            ?>
          </table>

        </div>
        <?php } ?>
      </div>
      <?=createFooter()?>
    </div>
  </body>
</html>
