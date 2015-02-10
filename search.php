<?php
include_once 'admin/php/book_info.php';
include_once 'admin/php/common.php';
include_once 'admin/php/displays.php';
?>
<!doctype html>
<html>
  <?=createBasicHead('Search Results', 'search')?>
  <body>

    <div id="container">
      <?=createHeader()?>
      <div class="content">
      <div id="search" class="centered box">
  
        <form method="get" action="<?=$_SERVER['PHP_SELF']?>">
          <input type="text" id="query" placeholder="search query" id="search-bar">
          <input type="submit" value="search" class="green button"> 
          
          <br>
          
          <div id="search-criteria-box">
            <h3>Search Criteria</h3>
            <input type="checkbox" name="criteria" value="title" id="criteria-title" checked>
            <label for="criteria-title" checked>Title</label>
            <input type="checkbox" name="criteria" value="author" id="criteria-author">
            <label for="criteria-author">Author</label>
            <input type="checkbox" name="criteria" value="publisher" id="criteria-publisher">
            <label for="criteria-publisher">Publisher</label>
            <input type="checkbox" name="criteria" value="isbn" id="criteria-isbn">
            <label for="criteria-isbn">ISBN</label>
          </div>
          <div id="search-category-box">
            <h3>Categories</h3>
            <input type="button" id="toggle-category-button" class="purple button" value="Select all">
            <!-- TODO: generate these from database -->
            <input type="checkbox" name="category" value="horror" id="category-horror" checked>
            <label for="category-horror">Horror</label>
            <input type="checkbox" name="category" value="scary" id="category-scary" checked>
            <label for="category-scary">Scary</label>
          </div>
          
        </form>
      </div>
      
      <!-- results here if applicable -->
      <?php if ($_GET['query']) { ?>
        <div id="search-results" class="centered box">
          <table id="books-in-cart" class="wide">
            <tr>
              <th>Remove</th>
              <th>Book Description</th>
              <th>Qty</th>
              <th>Price</th>
            </tr>
            
            <!-- TODO: generate rows from db -->
            <?php 
              $book = [
                  'id' => 1,
                  'title' => 'Absolute Java',
                  'author' => 'Walter Savitch',
                  'price' => '149.99',
                  'quantity' => '2',
                  'publisher' => 'Addison-Wesley',
                  'isbn' => '978-0132834230'
              ]
            ?>
            <tr>
              <td class="book-info"><input type="submit" class="purple button" value="Delete" name="delete <?=$book['id']?>">
              <td class="book-info"><?=generateBookInfo($book)?></td>
              <td class="book-info"><input type="text" name="quantity" class="quantity-box" value="<?=$book['quantity']?>"></td>
              <td class="book-info">$<?=$book['price']*$book['quantity']?></td>
            </tr>
            
          </table>
      
        </div>
        <?php } ?>
      </div>
      <?=createFooter()?>
    </div>
  </body>
</html>
