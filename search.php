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
          <input type="checkbox" name="criteria" value="title" id="criteria-title" form="<?=$search_id?>" checked>
          <label for="criteria-title" checked>Title</label>
          <input type="checkbox" name="criteria" value="author" id="criteria-author" form="<?=$search_id?>">
          <label for="criteria-author">Author</label>
          <input type="checkbox" name="criteria" value="publisher" id="criteria-publisher" form="<?=$search_id?>">
          <label for="criteria-publisher">Publisher</label>
          <input type="checkbox" name="criteria" value="isbn" id="criteria-isbn" form="<?=$search_id?>">
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
          while($genre = $stmt->fetch(PDO::FETCH_ASSOC)) {
          ?>
          <input type="checkbox" name="category[]"
              value="<?=$genre['name']?>" id="category-<?=$genre['name']?>"
              form="<?=$search_id?>"
              <?php
                foreach ($_GET['catagory'] as $checked_genre) {
                  if ($genre['name'] == $checked_genre) {
                     echo ' checked="checked"';
                     break;
                  }
                }
              ?>>
          <label for="category-<?=$genre['name']?>"><?=$genre['name']?></label>
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

            <!-- TODO: generate rows from db -->
            <?php
              $db = open_connection();
              $sql = "SELECT title, price, isbn, description,
                              publisher.name as publisher, genre.name as genre,
                              first_name, last_name
                      FROM book,author,publisher,genre
                      WHERE author_id=author.id
                            AND publisher_id=publisher.id
                            AND genre_id=genre.id
                      LIMIT 10;";
              $stmt = $db->prepare($sql);
              $stmt->execute();
              while($book = $stmt->fetch(PDO::FETCH_ASSOC)) {

            ?>
            <tr>
              <td class="book-info">
                <input type="button" class="green button centered-input"
                    value="Add to cart" name="add <?=$book['isbn']?>">
              </td>
                <td class="book-info">
                  <a href="review.php?id=<?=$book['isbn']?>" class="blue button centered-input">Reviews</a>
                </td>
              <td class="book-info"><?=generateBookInfo($book)?></td>
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
