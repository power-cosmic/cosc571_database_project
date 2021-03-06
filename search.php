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
          <?php
            $cart = Cart::get_instance();
              $search_criteria = [
                'title'=>'Title',
                'author'=>'Author',
                'publisher'=>'Publisher',
                'isbn'=>'ISBN'
              ];

              foreach ($search_criteria as $criteria=>$criteria_display) {
          ?>
          <input type="checkbox" name="criteria[<?=$criteria?>]"
                                  value="<?=$criteria?>" id="criteria-<?=$criteria?>"
                                  form="<?=$search_id?>" <?php
                foreach ($_GET['criteria'] as $checked_criteria) {
                  if ($criteria == $checked_criteria) {
                     echo ' checked="checked"';
                     break;
                  }
                }
              ?>>
          <label for="criteria-<?=$criteria?>"><?=$criteria_display?></label>
          <?php
              }
          ?>
        </div>
        <div id="search-category-box">
          <h3>Categories</h3>
          <input type="button" id="toggle-category-button" class="purple button" value="Select all">
          <div id="catagory-holder" style="position:relative; left:10%;">
          <table>
          <tr>
          <?php
          $sql = "SELECT name FROM genre;";
          $db = open_connection();
          $stmt = $db->prepare($sql);
          $stmt->execute();

          $category_num = 0;
          while($genre = $stmt->fetch(PDO::FETCH_ASSOC)) {
          ?>
          <td>
          <input type="checkbox" name="category[<?=$category_num++?>]"
              value="<?=$genre['name']?>" id="category-<?=str_replace(' ', '_', $genre['name'])?>"
              form="<?=$search_id?>" <?php
                foreach ($_GET['category'] as $checked_genre) {
                  if ($genre['name'] == $checked_genre) {
                     echo ' checked="checked"';
                     break;
                  }
                }
              ?>>
          <label for="category-<?=str_replace(' ', '_', $genre['name'])?>"><?=$genre['name']?></label>
          </td>
          <?php
            if ($category_num % 5 == 0) {
              echo "</tr><tr>";
            }
          }
          ?>
             </tr>
            </table>
          </div>
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
              $sql = "SELECT DISTINCT title, price, book.isbn as isbn, description,
                              publisher.name as publisher,
                              first_name, last_name
                      FROM book,author,publisher,genre,book_genre
                      WHERE author_id=author.id
                            AND publisher_id=publisher.id
                            AND book.isbn=book_genre.isbn
                            AND book_genre.genre_id=genre.id";

              function get_specific_clauses($query, $criteria, $genres) {
                $toReturn = "
                              AND (
                                  (";
                $toReturn .= get_clauses_for_query_item(trim(array_pop($query)), $criteria, $genres);
                foreach ($query as $query_item) {
                  $toReturn .= " )
                                OR
                                  (";
                  $toReturn .= get_clauses_for_query_item(trim($query_item), $criteria, $genres);
                }
                $toReturn .= " )
                                )";
                return $toReturn;
              }

              function get_clauses_for_query_item($query_item, $criteria, $genres) {
                $toReturn = '';
                if ($criteria) {
                  $toReturn .= " (";
                  $at_least_one = false;
                  if ($criteria['author']) {
                    $toReturn .= "first_name LIKE '%" . $query_item . "%'";
                    $toReturn .= " OR last_name LIKE '%" . $query_item . "%'";

                    $at_least_one = true;
                  }
                  if ($criteria['title']) {
                    if ($at_least_one) {
                      $toReturn .= " OR ";
                    }
                    $toReturn .= "title LIKE '%" . $query_item . "%'";

                    $at_least_one = true;
                  }
                  if ($criteria['publisher']) {
                    if ($at_least_one) {
                      $toReturn .= " OR ";
                    }
                    $toReturn .= "publisher.name LIKE '%" . $query_item . "%'";

                    $at_least_one = true;
                  }
                  if ($criteria['isbn']) {
                    if ($at_least_one) {
                      $toReturn .= " OR ";
                    }
                    $toReturn .= "book.isbn LIKE '%" . $query_item . "%'";

                    $at_least_one = true;
                  }
                  $toReturn .= ")";
                } else {
                  $toReturn .= "title LIKE '%" . $query_item . "%'";
                  $toReturn .= " OR first_name LIKE '%" . $query_item . "%'";
                  $toReturn .= " OR last_name LIKE '%" . $query_item . "%'";
                }
                if ($genres) {
                  $toReturn .= " AND (";
                  $toReturn .= "genre.name = '" . array_pop($genres) . "'";
                  foreach ($genres as $selected_genre) {
                    $toReturn .= " OR genre.name = '" . $selected_genre . "'";
                  }
                  $toReturn .= " )";
                }
                return $toReturn;
              }

              $no_good_search_terms = [
                  'a',
                  'the',
                  'in',
                  'of',
                  'is',
                  'as',
                  'that',
                  'this',
                  'which',
                  'also',
                  'about',
                  'around',
                  'because',
                  'became',
                  'been',
                  'behind',
                  'both',
                  'best',
                  'better',
                  'cases',
                  'cannot',
                  'clearly',
                  'could'

              ];

              $matches = explode(',', $_GET['query']);
              $removed = array();

              $misspelled = [];
              $replaced = [];

              $ps = pspell_new("en");
              foreach ($matches as $key => $value) {
                $value = trim($value);
                $matches[$key] = trim($value);

                if (substr($value, 0, 1) === '+') {
                  $value = substr($value, 1);
                  $matches[$key] = $value;
                } elseif (strlen($value) <= 3 || in_array($value, $no_good_search_terms)) {
                  array_push($removed, $value);
                  unset($matches[$key]);
                } elseif (!pspell_check($ps, $matches[$key])) {
                  array_push($misspelled, $matches[$key]);
                  array_push($replaced, pspell_suggest($ps, $matches[$key])[0]);

                  unset($matches[$key]);

                }
              }

              $search_terms = (count($replaced)) ? array_merge($matches, $replaced) : $matches;
              $sql .= get_specific_clauses($search_terms, $_GET['criteria'], $_GET['category']);
              if (count($search_terms)) {
              //echo "<tr><td colspan='3'>$sql</td></tr>";
              $stmt = $db->prepare($sql);
              $stmt->execute();
              echo "<tr><td colspan='3'>"
                        . $stmt->rowCount() . ' results found for "'
                        . implode('", "', $matches) . '"</td></tr>';
              echo "<tr><td colspan='3'>" . "Search terms removed: "
                        . implode(', ', $removed) . "</td></tr>";
              echo "<tr><td colspan='3'>" . "Search terms misspelled: "
                        . implode(', ', $misspelled) . "</td></tr>";
              echo "<tr><td colspan='3'>" . "Search terms replaced: "
                        . implode(', ', $replaced) . "</td></tr>";
              while($book_data = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $book = new Book($book_data);
            ?>
            <tr class="book-row">
              <td class="book-info">
                <input type="button" class="green button centered-input add-button"
                    value="Add to cart" name="add <?=$book->isbn?>" <?=$cart->contains($book)? 'disabled':''?>>
              </td>
                <td class="book-info">
                  <input type="button" class="blue button centered-input"
                    value="Reviews" onclick="window.location.href='review.php?isbn=<?=$book->isbn?>'" />
                </td>
              <td class="book-info" style="position:relative;width:100%;">
              <a href="book.php?isbn=<?=$book->isbn?>" class="no-decoration">
                <?=$book->generateBookInfo()?>
              </a>
              <?php if ($_SESSION && $_SESSION['login'] && $_SESSION['login']->get_user_type() === 'user') { ?>
                <div style="position:absolute;float:right;
                              top:2px;right:3px;">
                  <input type="button" class="red button centered-input wishlist-button"
                      value="Add to wishlist" name="wish <?=$book->isbn?>"
                    <?php

                    $sql = "SELECT count(*) as num
                            FROM wishlist
                            WHERE customer_username=:username
                              AND book_isbn=:isbn;";
                    $stmt2 = $db->prepare($sql);
                    $stmt2->execute([
                        'isbn' => $book->isbn,
                        'username' => $_SESSION['login']->get_username()
                    ]);
                    $result2 = $stmt2->fetch(PDO::FETCH_ASSOC);
                    if ($result2['num'] > 0) {
                      echo ' disabled="disabled" ';
                    }

                    ?>
                     />

                </div>
          <?php }?>

              </td>
            </tr>
            <?php
              }
            ?>
          </table>

        </div>
        <?php }
          } ?>
      </div>
      <?=createFooter()?>
    </div>
  </body>
</html>
