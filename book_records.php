<?php
include_once 'admin/php/common.php';
include_once 'admin/php/displays.php';
include_once 'admin/php/constants.php';

session_start();

if ($_SESSION['logged_in'] == $GLOBALS['user_status']['admin']) {
  header('Location: ' . $GLOBALS['locations']['admin']);
  die();
}
?>
<!doctype html>
<html>
  <?=createBasicHead('Admin')?>
  <body>
    <div id="container">
      <?=createHeader()?>
      <div class="content">
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
      <?=createFooter()?>
    </div>
  </body>
</html>
