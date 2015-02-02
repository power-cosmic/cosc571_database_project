<?php
include_once 'admin/php/common.php';
include_once 'admin/php/displays.php';
?>
<!doctype html>
<html>
  <?=createBasicHead('3-B - Admin')?>
  <body>
  <div id="container">
    <?=createHeader()?>
    <div class="content">
      <div id="login" class="centered box">
        
        <p>
          <!-- TODO: generate this w/ php -->
          Registered users: 444
        </p>
        
        <table id="books-by-category">
          <tr>
            <th>Category</th>
            <th>Number of books</th>
          </tr>
          
          <!-- TODO: generate this w/ php -->
          <tr>
            <td>Category 1</td>
            <td>555</td>
          </tr>
          <tr>
            <td>Category 2</td>
            <td>234</td>
          </tr>
          
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
        
        <table id="book-table">
          <tr>
            <th>Title</th>
            <th>Number Reviews</th>
          </tr>
          
          <!-- TODO: generate this w/ php -->
          <tr>
            <td>Book 1</td>
            <td>654</td>
          </tr>
          <tr>
            <td>Book 2</td>
            <td>13</td>
          </tr>
          
        </table>
        
      </div>
    </div>
    <?=createFooter()?>
    </div>
</body>
</html>